<?php
include("header.php");

require_once("../model/veterinaire.php");
require_once("afficher.php");

$detail=Array('rendez-vous');
$targetDetail=Array('rdvVeterinaire');
modifListe(getVeterinaires(),"modif_veterinaire",$detail,$targetDetail,-1);

include("footer.php");