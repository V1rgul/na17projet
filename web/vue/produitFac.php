<?php
include("header.php");

require_once("../model/autres.php");
require_once("afficher.php");

$id_facture=$_GET['id'];

$detail='';
$targetDetail='';
modifListe(get_produits_par_facture($id_facture),"modif_rel_produit",$detail,$targetDetail,$id_facture);


include("footer.php");
