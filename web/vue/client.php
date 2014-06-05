<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");



$detail=Array('rendez-vous','animaux');
$targetDetail=Array('rdvClient','animaux');
modifListe(getClients(),"modif_client",$detail,$targetDetail);

include("footer.php");