<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");
retour();


$id_client=$_GET['id'];

$detail=Array('factures');
$targetDetail=Array('factures');
modifListe(getAnimauxClient($id_client),"modif_animaux",$detail,$targetDetail,$id_client);

include("footer.php");