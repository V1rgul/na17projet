<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Produit';
$nom=$_GET['id'];
$op=$_GET['op'];
$keyCols=Array('nom');
$keyVals=Array($nom);

if ($op=='supprimer') {
	$requete=deleteRowWithKeys($table,$keyCols,$keyVals);

}
if ($op=='ajouter'){

}
if ($op=='modifier') {
	$requete=getById($table,$keyCols,$keyVals);
}