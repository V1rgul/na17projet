BEGIN;

-- ENUM

CREATE TYPE enum_payment    AS ENUM ('espèces','carteBleue','chèque');
CREATE TYPE enum_prestation AS ENUM ('consultation','intervention','consultationEtIntervention');

-- TABLE

CREATE TABLE Especes(
    especes             VARCHAR,
    prix_consultation   REAL NOT NULL,
    PRIMARY KEY(especes)
);

CREATE TABLE Race(
    race                VARCHAR,
    especes             VARCHAR,
    prix_intervention    REAL NOT NULL,
    PRIMARY KEY(race),
    FOREIGN KEY(especes) REFERENCES Especes(especes)
);

CREATE TABLE Client(
    id_client       INTEGER,
    nom             VARCHAR NOT NULL,
    prenom          VARCHAR NOT NULL,
    email           VARCHAR,
    adresse_num     INTEGER,
    adresse_rue     VARCHAR,
    adresse_cp      INTEGER,
    adresse_ville   VARCHAR,
    num_tel         INTEGER,
    PRIMARY KEY(id_client),
    UNIQUE(nom,prenom,num_tel),
    UNIQUE(nom,prenom,adresse_num,adresse_rue,adresse_cp,adresse_ville),
    UNIQUE(email)
);

CREATE TABLE Animal(
    id_animal       INTEGER,
    nom             VARCHAR,
    code            INTEGER, 
    taille          INTEGER,
    poids           INTEGER,
    data_naissance  DATE,
    race            VARCHAR,
    id_client       INTEGER NOT NULL,
    PRIMARY KEY(id_animal),
    FOREIGN KEY(race)      REFERENCES Race(race),
    FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Veterinaire(
    id_veterinaire  INTEGER,
    nom             VARCHAR NOT NULL,
    prenom          VARCHAR NOT NULL,
    email           VARCHAR,
    adresse_num     INTEGER,
    adresse_rue     VARCHAR,
    adresse_cp      INTEGER,
    adresse_ville   VARCHAR,
    num_tel         INTEGER,
    PRIMARY KEY(id_veterinaire),
    UNIQUE(nom,prenom,num_tel),
    UNIQUE(nom,prenom,adresse_num,adresse_rue,adresse_cp,adresse_ville),
    UNIQUE(email)
);

CREATE TABLE Employe(
    id_employe      INTEGER,
    nom             VARCHAR NOT NULL,
    prenom          VARCHAR NOT NULL,
    email           VARCHAR,
    adresse_num     INTEGER,
    adresse_rue     VARCHAR,
    adresse_cp      INTEGER,
    adresse_ville   VARCHAR,
    num_tel         INTEGER,
    PRIMARY KEY(id_employe),
    UNIQUE(nom,prenom,num_tel),
    UNIQUE(nom,prenom,adresse_num,adresse_rue,adresse_cp,adresse_ville),
    UNIQUE(email)
);

CREATE TABLE Produit(
    nom         VARCHAR,
    quantite    INTEGER,
    prix_unitaire   REAL NOT NULL,
    PRIMARY KEY(nom)
);

CREATE TABLE Facture(
    id_facture      INTEGER,
    date_payment    DATE,
    paye            BOOLEAN,
    mode            enum_payment,
    id_employe      INTEGER NOT NULL,
    PRIMARY KEY(id_facture),
    FOREIGN KEY(id_employe) REFERENCES Employe(id_employe)
);

CREATE TABLE RDV(
    id_rdv          INTEGER,
    date            DATE,
    id_animal       INTEGER NOT NULL,
    id_veterinaire  INTEGER NOT NULL,
    id_facture      INTEGER ,
    type            enum_prestation NOT NULL,
    PRIMARY KEY(id_rdv),
    FOREIGN KEY(id_animal)      REFERENCES Animal(id_animal),
    FOREIGN KEY(id_veterinaire) REFERENCES Veterinaire(id_veterinaire),
    FOREIGN KEY(id_facture)     REFERENCES Facture(id_facture)
);

CREATE TABLE Ordonnances(
    id_ordonnances      INTEGER,
    id_veterinaire      INTEGER,
    PRIMARY KEY(id_ordonnances),
    FOREIGN KEY(id_veterinaire) REFERENCES Veterinaire(id_veterinaire)
);

CREATE TABLE Prescription(
    nom_produit     VARCHAR,
    id_ordonnances  INTEGER,
    quantite        INTEGER,
    PRIMARY KEY(nom_produit,id_ordonnances),
    FOREIGN KEY(nom_produit)    REFERENCES Produit(nom),
    FOREIGN KEY(id_ordonnances) REFERENCES Ordonnances(id_ordonnances)
);

-- id_produit => nom_produit
CREATE TABLE Rel_facture_produit(
    nom_produit     VARCHAR,
    id_facture      INTEGER,
    PRIMARY KEY(nom_produit,id_facture),
    FOREIGN KEY(nom_produit)    REFERENCES Produit(nom),
    FOREIGN KEY(id_facture)     REFERENCES Facture(id_facture)
);

CREATE TABLE Rel_ordonnance_facture(
    id_ordonnances  INTEGER,
    id_facture      INTEGER,
    PRIMARY KEY(id_ordonnances,id_facture),
    FOREIGN KEY(id_ordonnances) REFERENCES  Ordonnances(id_ordonnances),
    FOREIGN KEY(id_facture)     REFERENCES  Facture(id_facture)
);

CREATE SEQUENCE id_facture      START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE id_ordonnances  START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE id_veterinaire  START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE id_employe      START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE id_animal       START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE id_rdv          START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE id_client       START WITH 1 INCREMENT BY 1;

commit;
