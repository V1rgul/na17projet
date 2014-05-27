<?php
require_once("connect.php");
include "requetes.php";

$table = "Produit";

$idOrdonnances=1; // =1 pour tester les requetes
$columns1 = Array("nom","quantite", "prix_unitaire");

$query1 = getAll($table);
$query2 = getProduitGBOrdonnances($idOrdonnances);

$ligne1 = execQuery($query1, $columns1);
$ligne2 = execQuery($query2, $columns1);

?>
