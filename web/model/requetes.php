<?php

/*
--------------------------------------
Requetes générales
--------------------------------------
*/

/*
Renvoie les cols $columns pour la table $table
*/
function getCols($table,$columns){
	return " SELECT ".implode(",", $columns).
		   " FROM $table;";
}

/*
Renvoie tous les cols de la table $table
*/
function getAll($table){
	return "SELECT *
			FROM $table;";
}

/*
Update les cols d'une table
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

/*
Delete les colonnes de la table $table
*/
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
--------------------------------------
Requetes Getters "GROUP BY"
--------------------------------------
*/

/*
Renvoie la liste des rendez-vous d'un vétérinaire (idVeto)
*/
function getRdvGBVeterinaires($idVeto){
	return "SELECT *
			FROM RDV
			WHERE id_veterinaire = $idVeto
			ORDER BY date;";
}

/*
Renvoie la liste des rendez-vous d'un client (idClient)
*/
function getRdvGBClient($idClient){
	return "SELECT *
			FROM RDV
			WHERE id_animal 
			IN (
				SELECT id_animal
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
				SELECT id_facture
				FROM RDV
				WHERE id_animal= $idAnimal)
			ORDER BY date_payment;";
}

/*
Renvoie la liste des produit d'une ordonnace (idOrdonnace,)
*/
function getProduitGBOrdonnances($idOrdonnance){
	return "SELECT *
			FROM Produit
			WHERE nom
			IN(
				SELECT nom_produit
				FROM Prescription
				WHERE id_ordonnances=$idOrdonnance)
			ORDER BY nom;";
}

/*
--------------------------------------
Requetes Statistiques
--------------------------------------
*/

/*
Renvoie le nombre de prescriptions d'un médicament (d'un produit)
*/
function getNbPrescriptionsGBProduit(){
	return "SELECT nom_produit, count(*) AS NbPrescriptions
			FROM Prescription
			GROUP BY nom_produit
			ORDER BY NbPrescriptions;";
}

/*
Renvoie le nombre des rendez-vous par animal
*/
function getNbPRdvGBAnimal(){
	return "SELECT id_animal, count(id_rdv) AS NbRDV
			FROM RDV
			GROUP BY id_animal
			ORDER BY NbRDV DESC;";
}

/*
Renvoie le nombre des rendez-vous par client
*/
function getNbPRdvGBClient(){
	return "SELECT id_client, count(id_rdv) AS NbRDV
			FROM
				(SELECT id_rdv, id_animal
				FROM RDV) AS R,
				(SELECT A.id_animal, C.id_client
				FROM Animal A, Client C
				WHERE A.id_client = C.id_client) AS JOINTURE_ANIMAL_CLIENT
			WHERE R.id_animal = JOINTURE_ANIMAL_CLIENT.id_animal
			GROUP BY id_client
			ORDER BY NbRDV DESC;";
}


?>
