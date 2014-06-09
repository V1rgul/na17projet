<?php
include("header.php");

require_once("../model/stats.php");
require_once("afficher.php");

displayListe(getNbPrescriptionsGBProduit()); echo "<br>";
displayListe(getNbPRdvGBAnimal()); echo "<br>";
displayListe(getNbPRdvGBClient()); echo "<br>";
displayListe(getAgeOfAnimalCaredByProduct()); echo "<br>";
displayListe(getAvgOfPriceByFacture()); echo "<br>";
displayListe(getNbMedicamentPrescritsByVeterinaire()); echo "<br>";

include("footer.php");