<?php
include("header.php");

require_once("../model/autres.php");
require_once("afficher.php");

$detail='';
$targetDetail='';
modifListe(getProduits(),"modif_produit",$detail,$targetDetail,-1);


include("footer.php");