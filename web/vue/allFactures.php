<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");

$detail=Array('produit');
$targetDetail=Array('produitFac');
modifListe(getFactures(),"modif_factures",$detail,$targetDetail,-1);

include("footer.php");