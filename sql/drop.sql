BEGIN;

DROP TABLE Especes CASCADE;
DROP TABLE Race CASCADE;
DROP TABLE Animal CASCADE;
DROP TABLE Client CASCADE;
DROP TABLE Veterinaire CASCADE;
DROP TABLE Employe CASCADE;
DROP TABLE RDV CASCADE;
DROP TABLE Produit CASCADE;
DROP TABLE Facture CASCADE;
DROP TABLE Ordonnances CASCADE;
DROP TABLE Prescription CASCADE;
DROP TABLE Rel_facture_produit CASCADE;
-- DROP TABLE Rel_ordonnance_facture CASCADE;               

DROP FUNCTION addFactureFromRdv(integer, date, BOOLEAN, enum_payment, integer);
DROP FUNCTION update_stock();
DROP FUNCTION calcPrixTotal(integer);

DROP TYPE enum_payment CASCADE;
DROP TYPE enum_prestation CASCADE;
COMMIT;
