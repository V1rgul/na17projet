BEGIN;

INSERT INTO Especes VALUES
    ('chien',30),
    ('chat',50),
    ('rongeurs',20);

INSERT INTO Race VALUES
    ('shiba Inu','chien',50),
    ('beagle','chien',55),
    ('boxer','chien',60),
    ('carlin','chien',55),
    ('sphynx','chat',70),
    ('exotic','chat',70),
    ('persan','chat',75),
    ('Hamster','rongeurs',35),
    ('lapin','rongeurs',45),
    ('chinchilla','rongeurs',50);

INSERT INTO Client (nom,prenom,email,adresse_num,adresse_rue,adresse_cp,adresse_ville,num_tel) 
    VALUES
    ( 'tiset', 'sylvain','tisetsyl@etu.utc.fr',1,'square august ancelet','60200', 'Compiegne', '0652186601'),
    ( 'qiao', 'yang','yangqiao@etu.utc.fr',10,'rue des peups','75000', 'Paris', '0652120001'),
    ( 'wozny', 'virgil','woznyvir@etu.utc.fr',1,'la ruche','60200', 'Compiegne', '0600186601');

INSERT INTO Veterinaire (nom,prenom,email,adresse_num,adresse_rue,adresse_cp,adresse_ville,num_tel)
    VALUES
    ( 'Izir', 'Joe', 'hellojoe@gmail.com' ,1,'rue de la nation', '75000', 'Paris','0232443322'),
    ( 'Marchand', 'Abdel', 'helloabdel@gmail.com' ,3,'rue de la nation', '75000', 'Paris','0232443300'),
    ( 'Arnaud', 'Thibaud','hellothibaut@gmail.com',2,'rue des peupliers', '13000', 'Marseille','0000112233');

INSERT INTO Employe (nom,prenom,email,adresse_num,adresse_rue,adresse_cp,adresse_ville,num_tel)
    VALUES
    ( 'McConnely', 'Marcel','marcel@yahoo.com',4,'le parc', '08222', 'La FrancheVille','0022113344'),
    ( 'Monk', 'Jean','jeanmonk@gmail',10,'rue des notre dame','75000', 'Paris', '0652182222'),
    ( 'Melville', 'Adrien','melville@utc.fr',4,'rue des fleures','75000', 'Paris', '0652444601');

INSERT INTO Animal (nom,code,taille,poids,date_naissance,race,id_client)
    VALUES
    ('dog',NULL,50,25,'20/09/2010','shiba Inu',1),
    ('hello',41312341,40,20,'20/10/2011','boxer',1),
    ('happy',NULL,80,40,'16/05/2009','shiba Inu',2),
    ('sad',NULL,70,35,'07/04/2008','persan',2),
    ('world',12341235,50,38,'08/10/2000','lapin',3),
    ('beauty',1424534,36,12.3,'20/09/2009','Hamster',3);

INSERT INTO Produit (nom,quantite,prix_unitaire)
    VALUES
    ('Shampoing pour chien',100,12),
    ('Shampoing pour chat',70,10),
    ('Shampoing pour rongeurs',30,20),
    ('Croquettes pour chien',200,5),
    ('Os pour chien',80,2),
    ('Tondeuse',30,20);

INSERT INTO Facture (date_payment,paye,mode,id_employe)
    VALUES
    (NULL,false,'cheque',1),
    (NULL,false,'carteBleue',1),
    (NULL,false,NULL,2),
    ('20/09/2009',true,'carteBleue',2),
    ('21/09/2009',true,'cheque',1),
    ('22/09/2009',true,'cheque',2),
    ('20/09/2003',true,'especes',3);

INSERT INTO Ordonnances (id_veterinaire)
    VALUES
    (1),
    (1),
    (2),
    (2),
    (1),
    (3);
    
INSERT INTO Prescription (nom_produit,id_ordonnance,quantite)
    VALUES
    ('Shampoing pour chien',1,2),
    ('Shampoing pour chien',3,1),
    ('Shampoing pour chat',6,3),
    ('Shampoing pour chat',2,2),
    ('Tondeuse',4,4),
    ('Croquettes pour chien',1,5),
    ('Os pour chien',1,5),
    ('Shampoing pour rongeurs',4,4);

-- INSERT INTO Rel_ordonnance_facture (id_ordonnance,id_facture)
--     VALUES
--     (1,1),
--     (2,2),
--     (3,3),
--     (4,2),
--     (5,3),
--     (6,3);

INSERT INTO RDV (date,id_animal,id_veterinaire,id_facture,type)
    VALUES
    ('10/09/2009',1,1,1,'intervention'),
    ('11/09/2003',2,1,2,'consultation'),
    ('20/09/2002',3,2,3,'consultation'),
    ('20/10/2009',4,1,1,'intervention'),
    ('20/10/2003',5,1,4,'consultation'),
    ('20/10/2002',3,2,3,'consultationEtIntervention'),
    ('20/09/2012',4,2,NULL,'intervention'),
    ('10/09/2012',2,2,NULL,'consultationEtIntervention'),
    ('20/10/2008',5,1,NULL,'consultation');

INSERT INTO Rel_facture_produit (nom_produit,id_facture,remise,quantite)
    VALUES
    ('Os pour chien',1,0,5),
    ('Os pour chien',2,0,6),
    ('Croquettes pour chien',1,3,2),
    ('Tondeuse',3,0,4);
    
COMMIT;
