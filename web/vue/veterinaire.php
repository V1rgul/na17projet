<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table="Veterinaire";

$columns1 = Array("nom", "prenom");
$columns2 = Array("id_veterinaire", "nom", "prenom", "email", "adresse_num", "adresse_rue", "adresse_cp", "adresse_ville", "num_tel");

$query1 = getCols($table, $columns1);
$query2 = getAll($table);


$ligne1 = execQuery($query1, $columns1);
$ligne2 = execQuery($query2, $columns2);


$detail=Array('rendez-vous');
$targetDetail=Array('rdvVeterinaire');
modifListe($ligne2,$columns2,"modif_veterinaire",$detail,$targetDetail);