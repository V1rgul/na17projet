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
    ('yang','qiao','yangqiao0505@me.com',NULL,NULL,NULL,NULL,NULL),
    ('rocca','joseph','roccajose@gmail.com',NULL,NULL,NULL,NULL,'0333333333'),
    ( 'TontoneL', 'Chauffard','justatest@etu.utc.fr',1,'rue des peups','17623', 'EasyTown', '0652186601');


INSERT INTO Veterinaire (nom,prenom,email,adresse_num,adresse_rue,adresse_cp,adresse_ville,num_tel)
    VALUES
    ( 'Izi', 'Joe',NULL,1,'rue dla nation', '09990', 'LTK','0232443322'),
    ( 'Arnaud', 'Thibaud','hellohello@gmail.com',1,'rue des peups', '17623', 'EasyTown','0000112233');

INSERT INTO Employe (nom,prenom,email,adresse_num,adresse_rue,adresse_cp,adresse_ville,num_tel)
    VALUES
    ( 'HAR', 'Zita','test@yahoo.com',NULL,'le parc', '09222', 'FahcileVille','0022113344'),
    ( 'TtoneL', 'Chffard','justatest@gmail',10,'rue des notre dame','17600', 'EasyTown', '0652182222'),
    ( 'TontoL', 'Chauffd','justatest@utc.fr',4,'rue des peups','87523', 'EasyTown', '0652444601');

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
    ('Advantage 40 chat et lapin de 1 à 4 kg - 4 pipettes',100,11.2),
    ('Advantix chien moyen (10 - 25 kg) - 4 pipettes',78,15.45),
    ('Advantix grand chien (25 - 40 kg) - 6 pipettes',1000,22.35),
    ('Apiguard',69,38.12),
    ('Shampooing PRO Dogteur Abricot 250 mL',999,8.99);

INSERT INTO Facture (date_payment,paye,mode,id_employe)
    VALUES
    (NULL,false,'cheque',1),
    ('20/09/2009',true,'carteBleue',2),
    ('20/09/2003',true,'especes',3);

INSERT INTO Ordonnances (id_veterinaire)
    VALUES
    (1),
    (1),
    (2),
    (2),
    (1),
    (1);
    
INSERT INTO Prescription (nom_produit,id_ordonnance,quantite)
    VALUES
    ('Advantage 40 chat et lapin de 1 à 4 kg - 4 pipettes',1,2),
    ('Advantage 40 chat et lapin de 1 à 4 kg - 4 pipettes',3,1),
    ('Advantage 40 chat et lapin de 1 à 4 kg - 4 pipettes',6,3),
    ('Apiguard',2,2),    
    ('Apiguard',4,4),
    ('Apiguard',1,5);

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
    ('20/09/2009',1,1,1,'intervention'),
    ('20/09/2003',2,1,2,'consultation'),
    ('20/09/2002',3,2,3,'consultation'),
    ('20/09/2012',4,2,NULL,'intervention'),
    ('20/10/2008',5,1,NULL,'consultation');

INSERT INTO Rel_facture_produit (nom_produit,id_facture,remise,quantite)
    VALUES
    ('Apiguard',1,0,5),
    ('Apiguard',2,0,6),
    ('Advantage 40 chat et lapin de 1 à 4 kg - 4 pipettes',1,0,2),
    ('Advantage 40 chat et lapin de 1 à 4 kg - 4 pipettes',3,0,4);
    
COMMIT;
