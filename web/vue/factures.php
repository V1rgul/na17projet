<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");

$id_animal=$_GET['id'];

$detail=Array('produit');
$targetDetail=Array('produitFac');
modifListe(getFacturesAnimal($id_animal),"modif_factures",$detail,$targetDetail,$id_animal);


include("footer.php");
