<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");

$detail=Array('produit');
$targetDetail=Array('produitFac');
$data=getFactures();
for ($i=0; $i < sizeof($data); $i++) { 
	$ligne=$data[$i];
	$ligne['prix']=prix_facture($ligne[$id_facture]);
	print_r($ligne);
	$data[$i]=$ligne;
	print_r($data[$i]);
}
modifListe($data,"modif_factures",$detail,$targetDetail,-1);

include("footer.php");