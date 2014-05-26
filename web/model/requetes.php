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
Renvoie le nom et le prénom de tous les vétérinaires
*/
function getCols($columns){
	return " SELECT ".implode(",", $columns).
		   " FROM Client;";
}

/*
Renvoie la liste de tous les vétérinaires
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
			in (
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
			FROM Animal
			WHERE 
			id_animal=$idAnimal
			ORDER BY nom;";
}

/*
Renvoie la liste des factures d'un animal (idAnimal)
*/
function getFacturesGBAnimal($idAnimal){
	return "SELECT *
			FROM Facture
			WHERE id_facture 
			in(
				Select id_facture
				FROM RDV
				WHERE id_animal= $idAnimal)
			ORDER BY date_payment;";
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
