<?php
include("header.php");

require_once("../model/stats.php");
require_once("afficher.php");

displayListe( getNbPrescriptionsGBProduit());
displayListe( getNbPRdvGBAnimal());
displayListe( getNbPRdvGBClient());
displayListe( getAgeOfAnimalCaredByProduct());
displayListe( getAvgOfPriceByFacture());
displayListe( getNbMedicamentPrescritsByVeterinaire());

include("footer.php");