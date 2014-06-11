<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");
retour();
$id_client=$_GET['id'];

$detail=Array('#Facturer');
$targetDetail=Array('modif_facturesRdv');

modifListe(getRdvClient($id_client),"modif_rdv",$detail,$targetDetail,$id_client);

include("footer.php");