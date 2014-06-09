<?php
include("header.php");

require_once("../model/veterinaire.php");
require_once("afficher.php");
$id_veterinaire=$_GET['id'];

$detail='';
$targetDetail='';
modifListe(getRdvVeterinaire($id_veterinaire),"modif_rdv",$detail,$targetDetail,$id_veterinaire);

include("footer.php");