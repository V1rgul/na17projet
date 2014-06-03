<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Veterinaire';
$id_veterinaire=$_GET['id'];
$op=$_GET['op'];
$keyCols=Array('id_veterinaire');
$keyVals=Array($id_veterinaire);

if ($op=='supprimer') {
	$requete=deleteRowWithKeys($table,$keyCols,$keyVals);

}
if ($op=='ajouter'){

}
if ($op=='modifier') {
	$requete=getById($table,$keyCols,$keyVals);
}