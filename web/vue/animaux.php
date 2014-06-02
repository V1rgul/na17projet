<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");
$id_client=$_GET['id'];

$columns = Array('id_animal','nom','code','taille','poids','data_naissance','race','id_client');

$query= getAnimalsGBClient($id_client);
$animalsClient= execQuery($query, $columns);

$detail=Array('ordonnances','factures');
$targetDetail=Array('ordonnances','factures');
modifListe($animalsClient,$columns,"modif_animaux",$detail,$targetDetail);
