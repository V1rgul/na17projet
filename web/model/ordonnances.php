<?php
require_once("connect.php");
require_once("requetes.php");
$idAnimal;
$columns = Array("id_ordonnances","id_veterinaire");

$query= getAnimalsGBClient($idAnimal);
$ordonnancesAnimal= execQuery($query, $columns);
