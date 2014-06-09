<?php
include("header.php");

require_once("../model/stats.php");
require_once("afficher.php");

getNbPrescriptionsGBProduit();
getNbPRdvGBAnimal();
getNbPRdvGBClient();
getAgeOfAnimalCaredByProduct();
getAvgOfPriceByFacture();
getNbMedicamentPrescritsByVeterinaire();

include("footer.php");