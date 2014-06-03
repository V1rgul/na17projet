<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Ordonnances';
$id_ordonnances=$_GET['id'];
$op=$_GET['op'];
$keyCols=Array('id_ordonnances');
$keyVals=Array($id_ordonnances);

if ($op=='supprimer') {
	$requete=deleteRowWithKeys($table,$keyCols,$keyVals);

}
if ($op=='ajouter'){

}
if ($op=='modifier') {
	$requete=getById($table,$keyCols,$keyVals);
}