<?php
include("header.php");

require_once("../model/stats.php");
require_once("afficher.php");

displayList(getNbPrescriptionsGBProduit()); echo "<br>";
displayList(getNbPRdvGBAnimal()); echo "<br>";
displayList(getNbPRdvGBClient()); echo "<br>";
displayList(getAgeOfAnimalCaredByProduct()); echo "<br>";
displayList(getAvgOfPriceByFacture()); echo "<br>";
displayList(getNbMedicamentPrescritsByVeterinaire()); echo "<br>";

include("footer.php");