<?php

require_once("connect.php");



//Liste des Clients
function getVeterinaires(){
	$columns = Array("id_veterinare", "nom", "prenom", "email", "adresse_num");
	$query = "SELECT ".implode(",", $columns)."
			FROM veterinaire;";
	return execQuery($query, $columns);
}
function addVeterinaire($nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	$query = "INSERT INTO veterinaire (nom,prenom, email, adresse_num, adresse_rue, adresse_cp, adresse_ville, num_tel)
			VALUES (".$nom.",".$prenom.",".$email.",".$adresse_num.",".$adresse_rue.",".$adresse_cp.",".$adresse_ville.",".$num_tel.")";
	execUpdate($query);
}
function updateVeterinaire($id_veterinaire, $nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	$query = "UPDATE veterinaire
			  WHERE id_veterinaire=".$id_veterinaire."
			  SET nom=".$nom.", prenom=".$prenom.", email=".$email.", adresse_num=".$adresse_num.", adresse_rue=".$adresse_rue.", adresse_cp=".$adresse_cp.", adresse_ville=".$adresse_ville.", num_tel=".$num_tel;
	execUpdate($query);
}


//Renvoie la liste des rendez-vous d'un vétérinaire (idVeto)
function getRdvVeterinaire($idVeto){
	$columns = Array("id_rdv", "date", "id_animal", "id_facture", "type");
	$query = "SELECT ".implode(",", $columns)."
			FROM RDV
			WHERE id_veterinaire = ".$idVeto."
			ORDER BY date;";
	return execQuery($query, $columns);
}
// See client.php for Add and Update -> addRdvAnimal and UpdateRdvAnimal
