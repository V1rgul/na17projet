<?php
include("header.php");

require_once("../model/autres.php");
require_once("afficher.php");
retour();
$id_ordonnance=$_GET['id'];

$detail='';
$targetDetail='';

modifListe(getProduitsOrdonnance($id_ordonnance),"modif_produitsOrd",$detail,$targetDetail,$id_ordonnance);

include("footer.php");