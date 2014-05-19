BEGIN;

DROP SEQUENCE id_facture    ;
DROP SEQUENCE id_ordonnances;
DROP SEQUENCE id_veterinaire;
DROP SEQUENCE id_employe    ;
DROP SEQUENCE id_animal     ;
DROP SEQUENCE id_rdv        ;
DROP SEQUENCE id_client     ;

DROP TABLE Especes CASCADE                  ;
DROP TABLE Race CASCADE                     ;
DROP TABLE Animal CASCADE                   ;
DROP TABLE Client CASCADE                   ;
DROP TABLE Veterinaire CASCADE              ;
DROP TABLE Employe CASCADE                  ;
DROP TABLE RDV CASCADE                      ;
DROP TABLE Produit CASCADE                  ;
DROP TABLE Facture CASCADE                  ;
DROP TABLE Ordonnances CASCADE              ;
DROP TABLE Prescription CASCADE             ;
DROP TABLE Rel_facture_produit CASCADE      ;
DROP TABLE Rel_ordonnance_facture CASCADE   ;               

DROP TYPE enum_payment CASCADE              ;
DROP TYPE enum_prestation CASCADE           ;

COMMIT;
