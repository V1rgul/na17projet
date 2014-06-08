<?php

require_once("connect.php");



//Liste des Clients
function getVeterinaires(){
	$columns = Array("id_veterinaire", "nom", "prenom", "email","adresse_num","adresse_rue","adresse_cp","adresse_ville","num_tel");
	$query = "SELECT ".implode(",", $columns)."
			FROM Veterinaire;";
	return execQuery($query, $columns);
}


function getVeterinaire($id_veterinaire){
	$columns = Array("nom", "prenom", "email","adresse_num","adresse_rue","adresse_cp","adresse_ville","num_tel");
	$query = "SELECT ".implode(",", $columns)."
			FROM Veterinaire
			WHERE id_veterinaire=".$id_veterinaire.";";
	$datas=execQuery($query, $columns);
	return $datas[0];
}

function addVeterinaire($nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
		if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
		if(empty($prenom)) $prenom='NULL';else $prenom="'".$prenom."'";
		if(empty($email)) $email='NULL';else $email="'".$email."'";
		if(empty($adresse_num)) $adresse_num='NULL';
		if(empty($adresse_rue)) $adresse_rue='NULL';else $adresse_rue="'".$adresse_rue."'";
		if(empty($adresse_cp)) $adresse_cp='NULL';else $adresse_cp="'".$adresse_cp."'";
		if(empty($adresse_ville)) $adresse_ville='NULL';else $adresse_ville="'".$adresse_ville."'";
		if(empty($num_tel)) $num_tel='NULL';else $num_tel="'".$num_tel."'";
	$query = "INSERT INTO Veterinaire (nom, prenom, email, adresse_num, adresse_rue, adresse_cp, adresse_ville, num_tel)
			VALUES (".$nom.",".$prenom.",".$email.",".$adresse_num.",".$adresse_rue.",".$adresse_cp.",".$adresse_ville.",".$num_tel.")";
	execUpdate($query);
}

function updateVeterinaire($id_veterinaire, $nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($prenom)) $prenom='NULL';else $prenom="'".$prenom."'";
	if(empty($email)) $email='NULL';else $email="'".$email."'";
	if(empty($adresse_num)) $adresse_num='NULL';
	if(empty($adresse_rue)) $adresse_rue='NULL';else $adresse_rue="'".$adresse_rue."'";
	if(empty($adresse_cp)) $adresse_cp='NULL';else $adresse_cp="'".$adresse_cp."'";
	if(empty($adresse_ville)) $adresse_ville='NULL';else $adresse_ville="'".$adresse_ville."'";
	if(empty($num_tel)) $num_tel='NULL';else $num_tel="'".$num_tel."'";
	$query = "UPDATE Veterinaire
			  SET nom=".$nom.", prenom=".$prenom.", email=".$email.", adresse_num=".$adresse_num.", adresse_rue=".$adresse_rue.", adresse_cp=".$adresse_cp.", adresse_ville=".$adresse_ville.", num_tel=".$num_tel."
			  WHERE id_veterinaire=".$id_veterinaire;
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
// See Veterinaire.php for Add and Update -> addRdvAnimal and UpdateRdvAnimal
