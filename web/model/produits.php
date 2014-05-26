<?php
require_once("connect.php");
require_once("requetes.php");
$idOrdonnaces;
$columns = Array("id_ordonnances","id_veterinaire");

$query= getProduitGBOrdonnances($idOrdonnaces);
$ordonnancesAnimal= execQuery($query, $columns);