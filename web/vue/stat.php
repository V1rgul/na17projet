<?php
include("header.php");

require_once("../model/stats.php");
require_once("afficher.php");
echo "<h3>le nombre de prescriptions d'un medicament (d'un produit)</h3><br>";
displayListe( getNbPrescriptionsGBProduit());
echo "<br><br>";
echo "<h3>le nombre des rendez-vous par animal </h3><br>";
displayListe( getNbPRdvGBAnimal());
echo "<br><br>";
echo "<h3>le nombre des rendez-vous par client </h3><br>";
displayListe( getNbPRdvGBClient());
echo "<br><br>";
echo "<h3>l'age moyen des animaux soignes avec un medicament (produit)</h3><br>";
displayListe( getAgeOfAnimalCaredByProduct());
echo "<br><br>";
echo "<h3>le montant moyen des factures</h3><br>";
displayListe( getAvgOfPriceByFacture());
echo "<br><br>";
echo "<h3>le nombre de medicaments (produits) prescrits par veterinaire (d'un produit)</h3><br>";
displayListe( getNbMedicamentPrescritsByVeterinaire());
echo "<br><br>";

include("footer.php");