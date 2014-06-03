<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Client';
$id_client=$_GET['id'];
$op=$_GET['op'];
$keyCols=Array('id_client');
$keyVals=Array($id_client);

if ($op=='supprimer') {
	$requete=deleteRowWithKeys($table,$keyCols,$keyVals);

}
if ($op=='ajouter'){

}
if ($op=='modifier') {
	$requete=getById($table,$keyCols,$keyVals);
}