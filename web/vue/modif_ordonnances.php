<?php
require_once("../model/client.php");
require_once("afficher.php");
include("include.php");

$id_ordonnance=$_GET['id'];
$id_veterinaire=$_GET['id_parent'];
$op=$_GET['op'];
if ($op=='supprimer') {
	deleteOrdonnance($id_ordonnance);
	operationSuccess();
}
else{
		if($op=='ajouter'){
			addOrdonnanceAnimal($id_veterinaire);
			operationSuccess();
		}
}
