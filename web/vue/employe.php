<?php
include("header.php");

require_once("../model/autres.php");
require_once("afficher.php");

$detail='';
$targetDetail='';
modifListe(getEmployes(),"modif_employe",$detail,$targetDetail,-1);

include("footer.php");