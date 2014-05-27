<?php
require_once("connect.php");
require_once("requetes.php");
$idClient;
$columns = Array('id_animal','nom','code','taille','poids','data_naissance','race','id_client');

$query= getAnimalsGBClient($idClient);
$animalsClient= execQuery($query, $columns);

