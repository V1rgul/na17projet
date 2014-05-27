<?php
require_once("connect.php");
include "requetes.php";

$table="Client";

$columns1 = Array("nom", "prenom");
$columns2 = Array("id_client", "nom", "prenom", "email", "adresse_num", "adresse_rue", "adresse_cp", "adresse_ville", "num_tel");
$columns3 = Array("id_rdv", "date", "id_animal", "id_facture", "type");

$query1 = getCols($table,$columns1);
$query2 = getAll($table);

$clientTable = execQuery($query1, $columns1);
$clientFullTable = execQuery($query2, $columns2);
