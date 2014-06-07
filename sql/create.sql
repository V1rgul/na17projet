BEGIN;

-- ENUM

CREATE TYPE enum_payment    AS ENUM ('espèces','carteBleue','chèque');
CREATE TYPE enum_prestation AS ENUM ('consultation','intervention','consultationEtIntervention');

-- TABLE

CREATE TABLE Especes(
    especes             VARCHAR,
    prix_consultation   REAL CHECK(prix_consultation>=0),
    PRIMARY KEY(especes)
);

CREATE TABLE Race(
    race                VARCHAR,
    especes             VARCHAR NOT NULL,
    prix_intervention    REAL CHECK(prix_intervention>=0),
    PRIMARY KEY(race),
    FOREIGN KEY(especes) REFERENCES Especes(especes)
);

CREATE TABLE Client(
    id_client       SERIAL,
    nom             VARCHAR NOT NULL,
    prenom          VARCHAR NOT NULL,
    email           VARCHAR,
    adresse_num     INTEGER CHECK(adresse_num>=0),
    adresse_rue     VARCHAR,
    adresse_cp      VARCHAR(5),
    adresse_ville   VARCHAR,
    num_tel         VARCHAR(10),
    PRIMARY KEY(id_client),
    UNIQUE(nom,prenom,num_tel),
    UNIQUE(nom,prenom,adresse_num,adresse_rue,adresse_cp,adresse_ville),
    UNIQUE(email)
);

CREATE TABLE Animal(
    id_animal       SERIAL,
    nom             VARCHAR,
    code            INTEGER, 
    taille          REAL CHECK(taille>0),
    poids           REAL CHECK(poids>0),
    date_naissance  DATE,
    race            VARCHAR,
    id_client       INTEGER NOT NULL,
    PRIMARY KEY(id_animal),
    FOREIGN KEY(race)      REFERENCES Race(race),
    FOREIGN KEY(id_client) REFERENCES Client(id_client) ON DELETE CASCADE
);

CREATE TABLE Veterinaire(
    id_veterinaire  SERIAL,
    nom             VARCHAR NOT NULL,
    prenom          VARCHAR NOT NULL,
    email           VARCHAR,
    adresse_num     INTEGER CHECK(adresse_num>=0),
    adresse_rue     VARCHAR,
    adresse_cp      VARCHAR(5),
    adresse_ville   VARCHAR,
    num_tel         VARCHAR(10),
    PRIMARY KEY(id_veterinaire),
    UNIQUE(nom,prenom,num_tel),
    UNIQUE(nom,prenom,adresse_num,adresse_rue,adresse_cp,adresse_ville),
    UNIQUE(email)
);

CREATE TABLE Employe(
    id_employe      SERIAL,
    nom             VARCHAR NOT NULL,
    prenom          VARCHAR NOT NULL,
    email           VARCHAR,
    adresse_num     INTEGER CHECK(adresse_num>=0),
    adresse_rue     VARCHAR,
    adresse_cp      VARCHAR(5),
    adresse_ville   VARCHAR,
    num_tel         VARCHAR(10),
    PRIMARY KEY(id_employe),
    UNIQUE(nom,prenom,num_tel),
    UNIQUE(nom,prenom,adresse_num,adresse_rue,adresse_cp,adresse_ville),
    UNIQUE(email)
);

CREATE TABLE Produit(
    nom         VARCHAR,
    quantite    INTEGER CHECK(quantite>0),
    prix_unitaire   REAL CHECK(prix_unitaire>0),
    PRIMARY KEY(nom)
);

CREATE TABLE Facture(
    id_facture      SERIAL,
    date_payment    DATE,
    paye            BOOLEAN NOT NULL,
    mode            enum_payment,
    id_employe      INTEGER NOT NULL,
    PRIMARY KEY(id_facture),
    FOREIGN KEY(id_employe) REFERENCES Employe(id_employe)
);

CREATE TABLE RDV(
    id_rdv          SERIAL,
    date            DATE,
    id_animal       INTEGER NOT NULL,
    id_veterinaire  INTEGER NOT NULL,
    id_facture      INTEGER ,
    type            enum_prestation NOT NULL,
    PRIMARY KEY(id_rdv),
    FOREIGN KEY(id_animal)      REFERENCES Animal(id_animal) ON DELETE CASCADE,
    FOREIGN KEY(id_veterinaire) REFERENCES Veterinaire(id_veterinaire) ON DELETE CASCADE,
    FOREIGN KEY(id_facture)     REFERENCES Facture(id_facture)
);

CREATE TABLE Ordonnances(
    id_ordonnance       SERIAL,
    id_veterinaire      INTEGER,
    PRIMARY KEY(id_ordonnance),
    FOREIGN KEY(id_veterinaire) REFERENCES Veterinaire(id_veterinaire)
);

CREATE TABLE Prescription(
    nom_produit     VARCHAR,
    id_ordonnance   INTEGER,
    quantite        INTEGER CHECK(quantite>=0),
    PRIMARY KEY(nom_produit,id_ordonnance),
    FOREIGN KEY(nom_produit)    REFERENCES Produit(nom),
    FOREIGN KEY(id_ordonnance) REFERENCES Ordonnances(id_ordonnance)
);

-- id_produit => nom_produit
CREATE TABLE Rel_facture_produit(
    nom_produit     VARCHAR,
    id_facture      INTEGER,
    remise          REAL CHECK(remise>=0),
    quantite        INTEGER CHECK(quantite>=0),
    PRIMARY KEY(nom_produit,id_facture),
    FOREIGN KEY(nom_produit)    REFERENCES Produit(nom),
    FOREIGN KEY(id_facture)     REFERENCES Facture(id_facture)
);

-- CREATE TABLE Rel_ordonnance_facture(
--     id_ordonnance   INTEGER,
--     id_facture      INTEGER,
--     PRIMARY KEY(id_ordonnance,id_facture),
--     FOREIGN KEY(id_ordonnance) REFERENCES  Ordonnances(id_ordonnance),
--     FOREIGN KEY(id_facture)     REFERENCES  Facture(id_facture)
-- );

-- Calcul le prix total d'une facture
CREATE OR REPLACE function calcPrixTotal(num_facture integer)
returns float AS
$$
declare
prix float;
BEGIN

SELECT PRIX_TOTAL.prix_total_par_facture INTO prix
            FROM
                (
                    (SELECT Re.id_facture, sum(P.prix_unitaire * Re.quantite) + PRIX_INTERV.prix_intervention - Re.remise  AS prix_total_par_facture
                    FROM Produit P, Rel_facture_produit Re,

                        (SELECT F.id_facture, sum(Ra.prix_intervention) as prix_intervention
                        FROM Facture F, RDV R, Animal A, Race Ra
                        WHERE F.id_facture = R.id_facture
                        AND R.id_animal = A.id_animal
                        AND A.race = Ra.race
                        AND R.type = 'intervention'
                        GROUP BY F.id_facture) AS PRIX_INTERV

                    WHERE P.nom = Re.nom_produit
                    AND Re.id_facture = PRIX_INTERV.id_facture
                    GROUP BY Re.id_facture, PRIX_INTERV.prix_intervention, Re.remise)

                    UNION

                    (SELECT Re.id_facture, sum(P.prix_unitaire * Re.quantite) + PRIX_PRESTATIONS.prix_prestation - Re.remise  AS prix_total_par_facture
                    FROM Produit P, Rel_facture_produit Re,

                    (SELECT F.id_facture, (sum(Ra.prix_intervention) + sum(E.prix_consultation)) as prix_prestation
                        FROM Facture F, RDV R, Animal A, Race Ra, Especes E
                        WHERE F.id_facture = R.id_facture
                        AND R.id_animal = A.id_animal
                        AND A.race = Ra.race
                        AND Ra.especes = E.especes
                        AND R.type = 'consultationEtIntervention'
                        GROUP BY F.id_facture) AS PRIX_PRESTATIONS

                    WHERE P.nom = Re.nom_produit
                    AND Re.id_facture = PRIX_PRESTATIONS.id_facture
                    GROUP BY Re.id_facture, PRIX_PRESTATIONS.prix_prestation, Re.remise)

                    UNION

                    (SELECT Re.id_facture, sum(P.prix_unitaire * Re.quantite) + PRIX_CONSULT.prix_consultation - Re.remise  AS prix_total_par_facture
                    FROM Produit P, Rel_facture_produit Re,

                        (SELECT F.id_facture, sum(E.prix_consultation) as prix_consultation
                        FROM Facture F, RDV R, Animal A, Race Ra, Especes E
                        WHERE F.id_facture = R.id_facture
                        AND R.id_animal = A.id_animal
                        AND A.race = Ra.race
                        AND Ra.especes = E.especes
                        AND R.type = 'consultation'
                        GROUP BY F.id_facture) AS PRIX_CONSULT

                    WHERE P.nom = Re.nom_produit
                    AND Re.id_facture = PRIX_CONSULT.id_facture
                    GROUP BY Re.id_facture, PRIX_CONSULT.prix_consultation, Re.remise)
                ) AS PRIX_TOTAL
            WHERE PRIX_TOTAL.id_facture = num_facture
        ;

return prix;
END;
$$
language plpgsql;

-- test :)
-- select * from calcPrixTotal(1);

-- Trigger qui met à jour la quantité en stock des Produits lorsque l'on insère un tuple dans la table rel_facture_produit
create or replace function update_stock()
returns trigger as 
$update_stock_on_product$
declare
stock float;
delta_stock float;
BEGIN   

select p.quantite into stock
from produit p
where p.nom = new.nom_produit
group by p.quantite;

delta_stock = new.quantite;

IF (delta_stock < stock) THEN
    UPDATE produit
    SET quantite = quantite - delta_stock
    WHERE nom = new.nom_produit;
    RETURN NEW;
ELSE
    RAISE NOTICE 'Le stock disponible : %', stock;
    RAISE NOTICE 'Le stock a inserer : %', delta_stock;
    RAISE EXCEPTION 'Pas assez de stock, on ne peut pas inserer !';
END IF;

END;
$update_stock_on_product$ LANGUAGE plpgsql;

CREATE TRIGGER update_stock_on_product
BEFORE INSERT ON Rel_facture_produit
    FOR EACH ROW EXECUTE PROCEDURE update_stock();


-- test :)
-- SELECT p.nom, p.quantite FROM produit p;

-- INSERT INTO Rel_facture_produit VALUES
--     ('Shampooing PRO Dogteur Abricot 250 mL',1,0,5),
--     ('Advantix chien moyen (10 - 25 kg) - 4 pipettes',3,0,4);

-- SELECT p.nom, p.quantite FROM produit p;

-- INSERT INTO Rel_facture_produit VALUES
--     ('Advantix grand chien (25 - 40 kg) - 6 pipettes',3,0,1003);

-- SELECT p.nom, p.quantite FROM produit p;

commit;
