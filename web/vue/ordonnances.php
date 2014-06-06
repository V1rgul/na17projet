<?php
include("header.php");

require_once("afficher.php");
$id_animaux=$_GET['id'];

$detail=Array('produits');
$targetDetail=Array('produitsOrdonnances');
modifListe(getOrdonnancesAnimal($id_animaux),$columns,"modif_ordonnances",$detail,$targetDetail);

include("footer.php");