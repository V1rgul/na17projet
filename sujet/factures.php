<?php
require_once("connect.php");
require_once("requetes.php");
$idAnimal;
$columns = Array("id_facture","date_payment","paye","mode","id_employe");

$query= getFacturesGBAnimal($idAnimal);
$facturesAnimal= execQuery($query, $columns);
