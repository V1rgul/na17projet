<?php
include("header.php");

require_once("../model/client.php");
require_once("afficher.php");
retour();
$id_animal=$_GET['id'];

$detail=Array('produit');
$targetDetail=Array('produitFac');
$data=getFacturesAnimal($id_animal);
for ($i=0; $i < sizeof($data); $i++) { 
	$ligne=$data[$i];
	$ligne['prix']=prix_facture($ligne["id_facture"]);
	$data[$i]=$ligne;
}
modifListe($data,"modif_factures",$detail,$targetDetail,$id_animal);


include("footer.php");
