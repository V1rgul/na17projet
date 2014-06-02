<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table = "Produit";
$columns = Array("nom","quantite", "prix_unitaire");
$query = getAll($table);
$ligne = execQuery($query, $columns1);

$detail='';
$targetDetail='';
modifListe($ligne,$columns,"modif_produit",$detail,$targetDetail);
