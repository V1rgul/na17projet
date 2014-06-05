<?php
include("header.php");

require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Client';
$columns1 = Array("nom", "prenom");
$columns2 = Array("id_client", "nom", "prenom", "email", "adresse_num", "adresse_rue", "adresse_cp", "adresse_ville", "num_tel");

$query1 = getCols($table,$columns1);
$query2 = getAll($table);

$clientTable = execQuery($query1, $columns1);
$clientFullTable = execQuery($query2, $columns2);

// displayListe($clientTable, $columns1);
$detail=Array('rendez-vous','animaux');
$targetDetail=Array('rdvClient','animaux');
modifListe($clientFullTable,$columns2,"modif_client",$detail,$targetDetail);

include("footer.php");