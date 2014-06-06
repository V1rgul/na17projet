<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");

$id_animal=$_GET['id'];
$columns = Array("id_facture","date_payment","paye","mode","id_employe");

$query= getFacturesGBAnimal($id_animal);
$facturesAnimal= execQuery($query, $columns);

$detail='';
$targetDetail='';
modifListe(getFacturesAnimal($id_animal),"modif_factures",$detail,$targetDetail);


include("footer.php");