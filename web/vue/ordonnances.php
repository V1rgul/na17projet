<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");
$id_animaux=$_GET['id'];

$detail=Array('produits');
$targetDetail=Array('produitsOrdonnances');
modifListe(getOrdonnancesAnimal($id_animaux),"modif_ordonnances",$detail,$targetDetail,$id_animaux);

include("footer.php");