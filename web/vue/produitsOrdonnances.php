<?php
include("header.php");

require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");
$id_ordonnances=$_GET['id'];

$columns = Array("nom","quantite", "prix_unitaire");
$query = getProduitGBOrdonnances($id_ordonnances);
$ligne = execQuery($query, $columns);

displayListe($ligne,$columns);

include("footer.php");