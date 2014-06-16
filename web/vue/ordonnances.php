<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");
retour();
$id_veterinaire=$_GET['id'];

$detail=Array('produits');
$targetDetail=Array('produitsOrdonnances');
modifListe(getOrdonnancesAnimal($id_animaux),"modif_ordonnances",$detail,$targetDetail,$id_veterinaire);

include("footer.php");