<?php

/*
Renvoie le nom et le prénom de tous les vétérinaires
*/
function getVeterinaires($col1, $col2){
	return "SELECT $col1, $col2
			FROM Veterinaire;";
}

/*
Renvoie la liste de tous les vétérinaires
*/
function getVeterinairesAll(){
	return "SELECT *
			FROM Veterinaire;";
}

/*
Renvoie la liste des rendez-vous d'un vétérinaire (idVeto)
*/
function getRdvGBVeterinaires($idVeto){
	return "SELECT *
			FROM RDV
			WHERE id_veterinaire = $idVeto
			ORDER BY date;";
}

/*-----------------------------------
------------------------------------*/

/*
Renvoie les cols $columns pour la table $table
*/
function getCols($table,$columns){
	return " SELECT ".implode(",", $columns).
		   " FROM $table;";
}

/*
Update les cols d'un table
*/

function updateColsWithKeys($table,$columns,$values,$keyCols,$keyVals){
	if ((count($columns)!=count($Values))||(count($keyCols)!=count($keyVals))) {
		echo('Erreur : '."columns et values n'ont pas la meme taille".'<br />');
		return;
	}

	$requete="UPDATE $table SET ";
	for ($i=0; $i < count($columns); $i++) { 
		$requete=$requete.$columns[$i]."=".$values[$i].",";
	}
	$requete=trim($requete,",")." WHERE $keyCols[0]=$keyVals[0]";
	for ($i=1; $i < count($keyCols); $i++) { 
		$requete=$requete." AND $keyCols[$i]=$keyVals[$i]";
	}
	return $requete.";";
}

function deleteRowWithKeys($table,$keyCols,$keyVals)
{
	if (count($keyCols)!=count($keyVals)) {
		echo('Erreur : '."columns et values n'ont pas la meme taille".'<br />');
		return;
	}

	$requete="DELETE FROM $table WHERE $keyCols[0]=$keyVals[0]";
	for ($i=1; $i < count($keyCols); $i++) { 
		$requete=$requete." AND $keyCols[$i]=$keyVals[$i]";
	}
	return $requete.";";
}

/*
Renvoie tous les cols de la table $table
*/
function getAll($table){
	return "SELECT *
			FROM $table;";
}


/*
Renvoie la liste des rendez-vous d'un client (idClient)
*/
function getRdvGBClient($idClient){
	return "SELECT *
			FROM RDV
			WHERE id_animal 
			IN (
				Select id_animal
				FROM Animal
				WHERE id_client= $idClient)
			ORDER BY date;";
}

/*
Renvoie la liste des animals d'un client (idClient)
*/
function getAnimalsGBClient($idClient){
	return "SELECT *
			FROM Animal
			WHERE 
			id_client=$idClient
			ORDER BY nom;";
}

/*
Renvoie la liste des ordonnances d'un animal (idAnimal)
*/
function getOrdonnancesGBAnimal($idAnimal){
	return "SELECT *
			FROM Ordonnances
			WHERE id_veterinaire
			IN(
				SELECT id_veterinaire
				FROM RDV
				WHERE id_animal=$idAnimal);";
}

/*
Renvoie la liste des factures d'un animal (idAnimal)
*/
function getFacturesGBAnimal($idAnimal){
	return "SELECT *
			FROM Facture
			WHERE id_facture 
			IN(
				Select id_facture
				FROM RDV
				WHERE id_animal= $idAnimal)
			ORDER BY date_payment;";
}

/*
Renvoie la liste des produit d'un ordonnaces (idOrdonnace,)
*/
function getProduitGBOrdonnances($idOrdonnace){
	return "SELECT *
			FROM Produit
			WHERE nom_produit
			IN(
				SELECT *
				FROM Prescription
				WHERE id_ordonnaces=$idOrdonnace)
			ORDER BY nom_produit;";
}
