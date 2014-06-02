<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='RDV';
$id_rdv=$_GET['id'];
$op=$_GET['op'];
$keyCols=Array('id_rdv');
$keyVals=Array($id_rdv);

if ($op=='supprimer') {
	deleteRowWithKeys($table,$keyCols,$keyVals);
}
if ($op=='ajouter'){
	
}
if ($op=='modifer') {
	getById($table,$keyCols,$keyVals);
}