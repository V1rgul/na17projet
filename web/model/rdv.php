<?php
require_once("connect.php");
include "requetes.php";

$idClient=1; // =1 pour tester les requetes
$columns = Array("id_rdv", "date", "id_animal", "id_facture", "type");
$query= getRdvGBClient($idClient);

$clientRDV= execQuery($query, $columns);
