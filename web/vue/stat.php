<?php
include("header.php");

require_once("../model/stats.php");
require_once("afficher.php");

$nbPrescriptionsGBProduit=getNbPrescriptionsGBProduit();
foreach ($nbPrescriptionsGBProduit as $key => $value) {
	displayListe($value); echo "<br>";	
}
$nbPRdvGBAnimal=getNbPRdvGBAnimal();
foreach ($nbPRdvGBAnimal as $key => $value) {
	displayListe($value); echo "<br>";	
}
$nbPRdvGBClient=getNbPRdvGBClient();
foreach ($nbPRdvGBClient as $key => $value) {
	displayListe($value); echo "<br>";	
}
$ageOfAnimalCaredByProduct=getAgeOfAnimalCaredByProduct();
foreach ($ageOfAnimalCaredByProduct as $key => $value) {
	displayListe($value); echo "<br>";	
}
$avgOfPriceByFacture=getAvgOfPriceByFacture();
foreach ($avgOfPriceByFacture as $key => $value) {
	displayListe($value); echo "<br>";	
}
$nbMedicamentPrescritsByVeterinaire=getNbMedicamentPrescritsByVeterinaire();
foreach ($nbMedicamentPrescritsByVeterinaire as $key => $value) {
	displayListe($value); echo "<br>";	
}

include("footer.php");