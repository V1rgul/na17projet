<?php
require_once("connect.php");
require_once("requetes.php");
$idClient;
$columns = Array("id_rdv", "date", "id_animal", "id_facture", "type");
$query= getRdvGBClient($idClient);

$clientRDV= execQuery($query, $columns);