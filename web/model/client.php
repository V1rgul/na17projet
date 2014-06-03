<?php

require_once("connect.php");




//Liste des Clients
function getClients(){
	$colums = Array("id_client", "nom", "prenom", "email", "adresse_num");
	$query = "SELECT ".implode(",", $columns)."
			FROM client;";
	return execQuery($query, $columns);
}
function addClient($nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	$query = "INSERT INTO client (prenom, email, adresse_num, adresse_rue, adresse_cp, adresse_ville, num_tel)
			VALUES (".$nom.",".$prenom.",".$email.",".$adresse_num.",".$adresse_rue.",".$adresse_cp.",".$adresse_ville.",".$num_tel.")";
	execUpdate($query);
}
function updateClient($id_client, $nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	$query = "UPDATE client
			  WHERE id_client=".$id_client."
			  SET nom=".$nom.", prenom=".$prenom.", email=".$email.", adresse_num=".$adresse_num.", adresse_rue=".$adresse_rue.", adresse_cp=".$adresse_cp.", adresse_ville=".$adresse_ville.", num_tel=".$num_tel;
	execUpdate($query);
}





//Renvoie la liste des rendez-vous d'un client (idClient)
function getRdvClient($idClient){
	$columns = Array("id_rdv", "date", "id_animal", "id_facture", "type");
	$query = "SELECT ".implode(",", $columns)."
			FROM rdv
			WHERE id_animal 
			IN (
				SELECT id_animal
				FROM Animal
				WHERE id_client= ".$idClient.")
			ORDER BY date;";
	return execQuery($query, $columns);
}
function addRdvAnimal($date, $id_animal, $id_facture, $type){
	$query = "INSERT INTO rdv (date, id_animal, id_facture, type)
			VALUES (".$date.",".$id_animal.",".$id_facture.",".$type.")";
	execUpdate($query);
}
function updateRdvAnimal($id_rdv, $date, $id_animal, $id_facture, $type){
	$query = "UPDATE rdv
			WHERE id_rdv=".$id_rdv."
			SET date=".$date.", id_animal=".$id_animal.", id_facture=".$id_facture.", type=".$type.")";
	execUpdate($query);
}
















//Renvoie la liste des animals d'un client (idClient)
function getAnimauxClient($idClient){
	$columns = Array("id_animal", "nom", "code", "taille", "poids", "data_naissance", "race");
	$query = "SELECT ".implode(",", $columns)."
			FROM Animal
			WHERE 
			id_client=".$idClient."
			ORDER BY nom;";
	return execQuery($query, $columns);
}



//Renvoie la liste des ordonnances d'un animal (idAnimal)
function getOrdonnancesAnimal($idAnimal){
	$columns = Array("id_ordonnances","id_veterinaire");
	$query = "SELECT ".implode(",", $columns)."
			FROM Ordonnances
			WHERE id_veterinaire
			IN(
				SELECT id_veterinaire
				FROM RDV
				WHERE id_animal=$idAnimal);";
	return execQuery($query, $columns);
}

/*
//Renvoie la liste des factures d'un animal (idAnimal)
function getFacturesAnimal($idAnimal){
	return "SELECT *
			FROM Facture
			WHERE id_facture 
			IN(
				SELECT id_facture
				FROM RDV
				WHERE id_animal= $idAnimal)
			ORDER BY date_payment;";
}
*/