<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Animal';
$id_animal=$_GET['id'];
$op=$_GET['op'];
$keyCols=Array('id_animal');
$keyVals=Array($id_animal);

if ($op=='supprimer') {
	deleteRowWithKeys($table,$keyCols,$keyVals);
}
if ($op=='ajouter'){
	
}
if ($op=='modifer') {
	getById($table,$keyCols,$keyVals);
}