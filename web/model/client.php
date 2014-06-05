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
			SET date=".$date.", id_animal=".$id_animal.", id_facture=".$id_facture.", type=".$type;
	execUpdate($query);
}






//Renvoie la liste des animals d'un client (idClient)
function getAnimauxClient($id_client){
	$columns = Array("id_animal", "nom", "code", "taille", "poids", "date_naissance", "race");
	$query = "SELECT ".implode(",", $columns)."
			FROM Animal
			WHERE 
			id_client=".$id_client."
			ORDER BY nom;";
	return execQuery($query, $columns);
}
function addAnimalClient($id_client, $nom, $code, $taille, $poids, $date_naissance, $race){
	$query = "INSERT INTO Animal (id_client, nom, code, taille, poids, date_naissance, race)
			VALUES (".$id_client.", ".$nom.", ".$code.", ".$taille.", ".$poids.", ".$date_naissance.", ".$race.")";
	execUpdate($query);
}
function updateAnimalClient($id_animal, $id_client, $nom, $code, $taille, $poids, $date_naissance, $race){
	$query = "UPDATE Animal
			WHERE id_animal=".$id_animal."
			SET id_client=".$id_client.", nom=".$nom.", code=".$code.", taille=".$taille.", poids=".$poids.", data_naissance=".$data_naissance.", race=".$race;
	execUpdate($query);
}




//Renvoie la liste des ordonnances d'un animal (idAnimal)
function getOrdonnancesAnimal($id_animal){
	$columns = Array("id_ordonnances","id_veterinaire");
	$query = "SELECT ".implode(",", $columns)."
			FROM Ordonnances
			WHERE id_veterinaire
			IN(
				SELECT id_veterinaire
				FROM RDV
				WHERE id_animal=$id_animal);";
	return execQuery($query, $columns);
}
function addOrdonnanceAnimal($id_animal, $id_veterinaire){
	$query = "INSERT INTO Ordonnances (id_animal, id_veterinaire)
			VALUES (".$id_animal.", ".$id_veterinaire.")";
	execUpdate($query);
}
function updateOrdonnanceAnimal($id_ordonnance, $id_animal, $id_veterinaire){
	$query = "UPDATE Animal
			WHERE id_ordonnance=".$id_ordonnance."
			SET id_animal=".$id_animal.", id_veterinaire=".$id_veterinaire;
	execUpdate($query);
}


//Renvoie la liste des factures d'un animal (idAnimal)
function getFacturesAnimal($idAnimal){
	$columns = Array("id_facture", "date_payment", "paye", "mode", "id_employe");
	return "SELECT ".implode(",", $columns)."
			FROM Facture
			WHERE id_facture 
			IN(
				SELECT id_facture
				FROM RDV
				WHERE id_animal= $idAnimal)
			ORDER BY date_payment;";
	return execQuery($query, $columns);
}
function addFactureAnimal($date_payment, $paye, $mode, $id_employe){
	$query = "INSERT INTO Facture (date_payment, paye, mode, id_employe)
			VALUES (".$date_payment.", ".$paye.", ".$mode.", ".$id_employe.")";
	execUpdate($query);
}
function updateFactureAnimal($id_facture, $date_payment, $paye, $mode, $id_employe){
	$query = "UPDATE Facture
			WHERE id_facture=".$id_facture."
			SET date_payment=".$date_payment.", paye=".$paye.", mode=".$mode.", id_employe=".$id_employe;
	execUpdate($query);
}