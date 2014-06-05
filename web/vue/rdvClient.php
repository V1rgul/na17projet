<?php
include("header.php");

require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");
$id_client=$_GET['id'];

$columns = Array("id_rdv", "date", "id_animal","id_veterinaire", "id_facture", "type");
$query= getRdvGBClient($id_client);

$rdvClient= execQuery($query, $columns);

$detail='';
$targetDetail='';
modifListe($rdvClient,$columns,"modif_rdv",$detail,$targetDetail);

include("footer.php");