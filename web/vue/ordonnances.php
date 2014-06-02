<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");
$id_animaux=$_GET['id'];
$columns = Array("id_ordonnances","id_veterinaire");

$query= getOrdonnancesGBAnimal($id_animaux);
$ordonnancesAnimal= execQuery($query, $columns);

$detail=Array('produits');
$targetDetail=Array('produitsOrdonnances');
modifListe($ordonnancesAnimal,$columns,"modif_ordonnances",$detail,$targetDetail);