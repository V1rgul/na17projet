<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");
$id_veterinaire=$_GET['id'];
$columns = Array("id_rdv", "date", "id_animal", "id_facture", "type");
$query = getRdvGBVeterinaires($id_veterinaire);
$ligne = execQuery($query, $columns);

$detail='';
$targetDetail='';
modifListe($ligne,$columns,"modif_rdv",$detail,$targetDetail);