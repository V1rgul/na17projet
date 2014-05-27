<?php
require_once("connect.php");
<<<<<<< HEAD
include "requetes.php";

$table = "Produit";

$idOrdonnances=1; // =1 pour tester les requetes
$columns1 = Array("nom","quantite", "prix_unitaire");

$query1 = getAll($table);
$query2 = getProduitGBOrdonnances($idOrdonnances);

$ligne1 = execQuery($query1, $columns1);
$ligne2 = execQuery($query2, $columns1);

?>
=======
require_once("requetes.php");
$idOrdonnaces;
$columns = Array("id_ordonnances","id_veterinaire");

$query= getProduitGBOrdonnances($idOrdonnaces);
$ordonnancesAnimal= execQuery($query, $columns);
>>>>>>> 0946058fcc7d923de34e7c1841774090343a26ae
