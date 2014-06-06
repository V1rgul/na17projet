<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");
$id_client=$_GET['id'];

$detail='';
$targetDetail='';
modifListe(getRdvClient($id_client),"modif_rdv",$detail,$targetDetail);

include("footer.php");