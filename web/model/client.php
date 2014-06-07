<?php

require_once("connect.php");

//Liste des Clients
function getClients(){
	$columns = Array("id_client", "nom", "prenom", "email","adresse_num","adresse_rue","adresse_cp","adresse_ville","num_tel");
	$query = "SELECT ".implode(",", $columns)."
			FROM client;";
	return execQuery($query, $columns);
}


function getClient($id_client){
	$columns = Array("nom", "prenom", "email","adresse_num","adresse_rue","adresse_cp","adresse_ville","num_tel");
	$query = "SELECT ".implode(",", $columns)."
			FROM client
			WHERE id_client=".$id_client.";";
	$datas=execQuery($query, $columns);
	return $datas[0];
}

function addClient($nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
		if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
		if(empty($prenom)) $prenom='NULL';else $prenom="'".$prenom."'";
		if(empty($email)) $email='NULL';else $email="'".$email."'";
		if(empty($adresse_num)) $adresse_num='NULL';
		if(empty($adresse_rue)) $adresse_rue='NULL';else $adresse_rue="'".$adresse_rue."'";
		if(empty($adresse_cp)) $adresse_cp='NULL';else $adresse_cp="'".$adresse_cp."'";
		if(empty($adresse_ville)) $adresse_ville='NULL';else $adresse_ville="'".$adresse_ville."'";
		if(empty($num_tel)) $num_tel='NULL';else $num_tel="'".$num_tel."'";
	$query = "INSERT INTO client (nom, prenom, email, adresse_num, adresse_rue, adresse_cp, adresse_ville, num_tel)
			VALUES (".$nom.",".$prenom.",".$email.",".$adresse_num.",".$adresse_rue.",".$adresse_cp.",".$adresse_ville.",".$num_tel.")";
	execUpdate($query);
}

function updateClient($id_client, $nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($prenom)) $prenom='NULL';else $prenom="'".$prenom."'";
	if(empty($email)) $email='NULL';else $email="'".$email."'";
	if(empty($adresse_num)) $adresse_num='NULL';
	if(empty($adresse_rue)) $adresse_rue='NULL';else $adresse_rue="'".$adresse_rue."'";
	if(empty($adresse_cp)) $adresse_cp='NULL';else $adresse_cp="'".$adresse_cp."'";
	if(empty($adresse_ville)) $adresse_ville='NULL';else $adresse_ville="'".$adresse_ville."'";
	if(empty($num_tel)) $num_tel='NULL';else $num_tel="'".$num_tel."'";
	$query = "UPDATE client
			  SET nom=".$nom.", prenom=".$prenom.", email=".$email.", adresse_num=".$adresse_num.", adresse_rue=".$adresse_rue.", adresse_cp=".$adresse_cp.", adresse_ville=".$adresse_ville.", num_tel=".$num_tel."
			  WHERE id_client=".$id_client;
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

function getRdv($id_rdv){
	$columns = Array("id_rdv", "date", "id_animal","id_veterinaire" ,"id_facture", "type");
	$query = "SELECT ".implode(",", $columns)."
			FROM rdv
			WHERE id_rdv=".$id_rdv;
	$datas=execQuery($query, $columns);
	return $datas[0];
}

function addRdvAnimal($date, $id_animal, $id_veterinaire , $id_facture, $type){
	if(empty($date)) $date='NULL';else $date="'".$date."'";
	if(empty($id_animal)) $id_animal='NULL';	
	if(empty($id_facture)) $id_facture='NULL';
	if(empty($type)) $type='NULL';else $type="'".$type."'";
	if(empty($id_veterinaire)) $id_veterinaire='NULL'; 
	$query = "INSERT INTO rdv (date, id_animal, id_veterinaire, id_facture, type)
			VALUES (".$date.",".$id_animal.",".$id_veterinaire.",".$id_facture.",".$type.")";
	execUpdate($query);
}
function updateRdvAnimal($id_rdv, $date, $id_animal, $id_veterinaire, $id_facture, $type){
	if(empty($date)) $date='NULL';else $date="'".$date."'";
	if(empty($id_animal)) $id_animal='NULL';
	if(empty($id_facture)) $id_facture='NULL';
	if(empty($type)) $type='NULL';else $type="'".$type."'";
	$query = "UPDATE rdv
			SET date=".$date.", id_animal=".$id_animal.", id_veterinaire=".$id_veterinaire.", id_facture=".$id_facture.", type=".$type."
			WHERE id_rdv=".$id_rdv;
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

function getAnimaux($id_animal){
	$columns = Array("id_animal", "nom", "code", "taille", "poids", "date_naissance", "race","id_client");
	$query = "SELECT ".implode(",", $columns)."
			FROM Animal
			WHERE id_animal=".$id_animal;
	$datas=execQuery($query, $columns);
	return $datas[0];
}

function addAnimalClient($id_client, $nom, $code, $taille, $poids, $date_naissance, $race){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($code)) $code='NULL';
	if(empty($taille)) $taille='NULL';
	if(empty($poids)) $poids='NULL';
	if(empty($date_naissance)) $date_naissance='NULL';else $date_naissance="'".$date_naissance."'";
	if(empty($race)) $race='NULL';else $race="'".$race."'";
	
	$query = "INSERT INTO Animal (id_client, nom, code, taille, poids, date_naissance, race)
			VALUES (".$id_client.", ".$nom.", ".$code.", ".$taille.", ".$poids.", ".$date_naissance.", ".$race.")";
	execUpdate($query);
}
function updateAnimalClient($id_animal, $id_client, $nom, $code, $taille, $poids, $date_naissance, $race){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($code)) $code='NULL';
	if(empty($taille)) $taille='NULL';
	if(empty($poids)) $poids='NULL';
	if(empty($date_naissance)) $date_naissance='NULL';else $date_naissance="'".$date_naissance."'";
	if(empty($race)) $race='NULL';else $race="'".$race."'";
	$query = "UPDATE Animal
			SET id_client=".$id_client.", nom=".$nom.", code=".$code.", taille=".$taille.", poids=".$poids.", data_naissance=".$data_naissance.", race=".$race."
			WHERE id_animal=".$id_animal;
	execUpdate($query);
}




//Renvoie la liste des ordonnances d'un animal (idAnimal)
function getOrdonnancesAnimal($id_animal){
	$columns = Array("id_ordonnance","id_veterinaire");
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
			SET id_animal=".$id_animal.", id_veterinaire=".$id_veterinaire."
			WHERE id_ordonnance=".$id_ordonnance;
	execUpdate($query);
}


//Renvoie la liste des factures d'un animal (idAnimal)
function getFacturesAnimal($idAnimal){
	$columns = Array("id_facture", "date_payment", "paye", "mode", "id_employe");
	$query="SELECT ".implode(",", $columns)."
			FROM Facture
			WHERE id_facture 
			IN(
				SELECT id_facture
				FROM RDV
				WHERE id_animal= $idAnimal)
			ORDER BY date_payment;";
	return execQuery($query, $columns);
}

function getFacture($id_facture){
	$columns = Array("date_payment", "paye", "mode", "id_employe");
	$query="SELECT ".implode(",", $columns)."
			FROM Facture
			WHERE id_facture =".$id_facture;
	$datas=execQuery($query, $columns);
	return $datas[0];
}

function addFactureAnimal($date_payment, $paye, $mode, $id_employe){
	if(empty($date_payment)) $date_payment='NULL';else $date_payment="'".$date_payment."'";
	if(empty($mode)) $mode='NULL';else $mode="'".$mode."'";
	if(empty($id_employe)) $id_employe='NULL';
	$query ="INSERT INTO Facture (date_payment, paye, mode, id_employe)
			VALUES (".$date_payment.", ".$paye.", ".$mode.", ".$id_employe.")";
	execUpdate($query);
}
function updateFactureAnimal($id_facture, $date_payment, $paye, $mode, $id_employe){
	if(empty($date_payment)) $date_payment='NULL';else $date_payment="'".$date_payment."'";
	if(empty($mode)) $mode='NULL';else $mode="'".$mode."'";
	if(empty($id_employe)) $id_employe='NULL';
	$query ="UPDATE Facture
			SET date_payment=".$date_payment.", paye='".$paye."', mode=".$mode.", id_employe=".$id_employe."
			WHERE id_facture=".$id_facture;
	execUpdate($query);
}

function payerFactureAnimal($id_facture, $date_payment, $mode_payment){
	if(empty($date_payment)) $date_payment='NULL';else $date_payment="'".$date_payment."'";
	if(empty($mode)) $mode='NULL';else $mode="'".$mode."'";
	$query ="UPDATE Facture
			SET date_payment=".$date_payment.", paye=1, mode=".$mode_payment."
			WHERE id_facture=".$id_facture;
	execUpdate($query);
}