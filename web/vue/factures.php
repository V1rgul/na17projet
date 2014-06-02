<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");
$id_animal=$_GET['id'];
$columns = Array("id_facture","date_payment","paye","mode","id_employe");

$query= getFacturesGBAnimal($id_animal);
$facturesAnimal= execQuery($query, $columns);

$detail='';
$targetDetail='';
modifListe($facturesAnimal,$columns,"modif_factures",$detail,$targetDetail);

