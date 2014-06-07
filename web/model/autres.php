<?php

require_once("connect.php");

// Gestion des produits
function getProduits(){
	$columns = Array("nom", "quantite", "prix_unitaire");
	$query = "SELECT ".implode(",", $columns)."
			FROM Produit
			ORDER BY nom;";
	return execQuery($query, $columns);
}
function addProduit($nom, $quantite, $prix_unitaire){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($quantite)) $quantite='NULL';else $quantite="'".$quantite."'";
	if(empty($prix_unitaire)) $prix_unitaire='NULL';else $prix_unitaire="'".$prix_unitaire."'";
	$query = "INSERT INTO Produit (nom, quantite, prix_unitaire)
			VALUES (".$nom.",".$quantite.",".$prix_unitaire.")";
	execUpdate($query);
}
function updateProduit($nom, $quantite, $prix_unitaire){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($quantite)) $quantite='NULL';else $quantite="'".$quantite."'";
	if(empty($prix_unitaire)) $prix_unitaire='NULL';else $prix_unitaire="'".$prix_unitaire."'";
	$query = "UPDATE Produit
			  SET quantite=".$quantite.", prix_unitaire=".$prix_unitaire."
			  WHERE nom=".$nom;
	execUpdate($query);
}

// gestion des employes
function getEmployes(){
	$columns = Array("id_employe", "nom", "prenom", "email", "adresse_num", "adresse_rue", "adresse_cp", "adresse_ville", "num_tel");
	$query = "SELECT ".implode(",", $columns)."
			FROM Employe
			ORDER BY id_employe;";
	return execQuery($query, $columns);
}
function addEmploye($nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($prenom)) $prenom='NULL';else $prenom="'".$prenom."'";
	if(empty($email)) $email='NULL';else $email="'".$email."'";
	if(empty($adresse_num)) $adresse_num='NULL';else $adresse_num="'".$adresse_num."'";
	if(empty($adresse_rue)) $adresse_rue='NULL';else $adresse_rue="'".$adresse_rue."'";
	if(empty($adresse_cp)) $adresse_cp='NULL';else $adresse_cp="'".$adresse_cp."'";
	if(empty($adresse_ville)) $adresse_ville='NULL';else $adresse_ville="'".$adresse_ville."'";
	if(empty($num_tel)) $num_tel='NULL';else $num_tel="'".$num_tel."'";
	
	$query = "INSERT INTO Employe (nom, prenom, email, adresse_num, adresse_rue, adresse_cp, adresse_ville, num_tel)
			VALUES (".$nom.",".$prenom.",".$email.",".$adresse_num.",".$adresse_rue.",".$adresse_cp.",".$adresse_ville.",".$num_tel")";
	execUpdate($query);
}
function updateEmploye($id_employe, $nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel){
	if(empty($nom)) $nom='NULL';else $nom="'".$nom."'";
	if(empty($prenom)) $prenom='NULL';else $prenom="'".$prenom."'";
	if(empty($email)) $email='NULL';else $email="'".$email."'";
	if(empty($adresse_num)) $adresse_num='NULL';else $adresse_num="'".$adresse_num."'";
	if(empty($adresse_rue)) $adresse_rue='NULL';else $adresse_rue="'".$adresse_rue."'";
	if(empty($adresse_cp)) $adresse_cp='NULL';else $adresse_cp="'".$adresse_cp."'";
	if(empty($adresse_ville)) $adresse_ville='NULL';else $adresse_ville="'".$adresse_ville."'";
	if(empty($num_tel)) $num_tel='NULL';else $num_tel="'".$num_tel."'";
	$query = "UPDATE Employe
			SET nom=".$nom.", prenom=".$prenom.", email=".$email.",
				adresse_num=".$adresse_num.", adresse_rue=".$adresse_rue.", adresse_cp=".$adresse_cp.",
				adresse_ville=".$adresse_ville.", num_tel=".$num_tel."
			WHERE id_employe=".$id_employe;
	execUpdate($query);
}
function deleteEmploye($id_employe){
	$query = "DELETE FROM Employe
			  WHERE id_employe=".$id_employe;
	execUpdate($query);
}

// gestion des factures (rel_facture_employe)
function getRel_facture_produit(){
	$columns = Array("nom_produit", "id_facture", "remise", "quantite");
	$query = "SELECT ".implode(",", $columns)."
			FROM Rel_facture_produit
			ORDER BY nom_produit, id_facture;";
	return execQuery($query, $columns);
}
function addRel_facture_produit($nom_produit, $id_facture, $remise, $quantite){
	if(empty($nom_produit)) $nom_produit='NULL';else $nom_produit="'".$nom_produit."'";
	if(empty($id_facture)) $id_facture='NULL';else $id_facture="'".$id_facture."'";
	if(empty($remise)) $remise='NULL';else $remise="'".$remise."'";
	if(empty($quantite)) $quantite='NULL';else $quantite="'".$quantite."'";

	$query = "INSERT INTO Rel_facture_produit (nom_produit, id_facture, remise, quantite)
			VALUES (".$nom_produit.",".$id_facture.",".$remise.",".$quantite.")";
	execUpdate($query);
}
function updateRel_facture_produit($nom_produit, $id_facture, $remise, $quantite){
	if(empty($nom_produit)) $nom_produit='NULL';else $nom_produit="'".$nom_produit."'";
	if(empty($id_facture)) $id_facture='NULL';else $id_facture="'".$id_facture."'";
	if(empty($remise)) $remise='NULL';else $remise="'".$remise."'";
	if(empty($quantite)) $quantite='NULL';else $quantite="'".$quantite."'";
	$query = "UPDATE Rel_facture_produit
			SET remise=".$remise.", quantite=".$quantite."
			WHERE nom_produit=".$nom_produit." AND id_facture=".$id_facture;
	execUpdate($query);
}
function deleteRel_facture_produit($nom_produit, $id_facture){
	$query = "DELETE FROM Rel_facture_produit
			  WHERE nom_produit=".$nom_produit." AND id_facture=".$id_facture;
	execUpdate($query);
}

// gestion des factures (Rdv)
function getRdv(){
	$columns = Array("id_rdv", "date", "id_animal", "id_veterinaire", "id_facture", "type");
	$query = "SELECT ".implode(",", $columns)."
			FROM Rdv
			ORDER BY id_rdv;";
	return execQuery($query, $columns);
}
function addRdv($date, $id_animal, $id_veterinaire, $id_facture , $type){
	if(empty($date)) $date='NULL';else $date="'".$date."'";
	if(empty($id_animal)) $id_animal='NULL';else $id_animal="'".$id_animal."'";
	if(empty($id_veterinaire)) $id_veterinaire='NULL';else $id_veterinaire="'".$id_veterinaire."'";
	if(empty($id_facture)) $id_facture='NULL';else $id_facture="'".$id_facture."'";
	if(empty($type)) $type='NULL';else $type="'".$type."'";

	$query = "INSERT INTO Rdv (date, id_animal, id_veterinaire, id_facture , type)
			VALUES (".$date.",".$id_animal.",".$id_veterinaire.",".$id_facture.",".$type.")";
	execUpdate($query);
}
function updateRdv($id_rdv, $date, $id_animal, $id_veterinaire, $id_facture , $type){
	if(empty($id_rdv)) $id_rdv='NULL';else $id_rdv="'".$id_rdv."'";
	if(empty($date)) $date='NULL';else $date="'".$date."'";
	if(empty($id_animal)) $id_animal='NULL';else $id_animal="'".$id_animal."'";
	if(empty($id_veterinaire)) $id_veterinaire='NULL';else $id_veterinaire="'".$id_veterinaire."'";
	if(empty($id_facture)) $id_facture='NULL';else $id_facture="'".$id_facture."'";
	if(empty($type)) $type='NULL';else $type="'".$type."'";
	
	$query = "UPDATE Rdv
			SET date=".$date.", id_animal=".$id_animal.", id_veterinaire=".$id_veterinaire."
			id_facture=".$id_facture.", type=".$type."
			WHERE id_rdv=".$id_rdv;
	execUpdate($query);
}
function deleteRdv($id_rdv){
	$query = "DELETE FROM Rdv
			  WHERE id_rdv=".$id_rdv;
	execUpdate($query);
}

//Gestion des produits d'ordonnances
function getProduitsOrdonnance($id_ordonnance){
	$columns = Array("nom", "quantite", "prix_unitaire");
	$query = "SELECT Produit.nom, Prescription.quantite, Produit.prix_unitaire
		FROM Produit, Prescription
		WHERE Produit.nom = Prescription.nom_produit AND Prescription.id_ordonnance=".$id_ordonnance."
		ORDER BY Produit.nom;";
	return execQuery($query, $columns);
}
function addProduitOrdonnance($nom_produit, $id_ordonnance, $quantite){
	if(empty($nom_produit)) $nom_produit='NULL';else $nom_produit="'".$nom_produit."'";
	if(empty($id_ordonnance)) $id_ordonnance='NULL';else $id_ordonnance="'".$id_ordonnance."'";
	if(empty($quantite)) $quantite='NULL';else $quantite="'".$quantite."'";
	$query = "INSERT INTO Prescription (nom_produit, id_ordonnance, quantite)
			VALUES (".$nom_produit.",".$id_ordonnance.",".$quantite.")";
	execUpdate($query);
}
function updateProduitOrdonnance($nom_produit, $id_ordonnance, $quantite){
	if(empty($nom_produit)) $nom_produit='NULL';else $nom_produit="'".$nom_produit."'";
	if(empty($id_ordonnance)) $id_ordonnance='NULL';else $id_ordonnance="'".$id_ordonnance."'";
	if(empty($quantite)) $quantite='NULL';else $quantite="'".$quantite."'";
	$query = "UPDATE Prescription
			  SET quantite=".$quantite."
			  WHERE nom_produit=".$nom_produit.", id_ordonnance=".$id_ordonnance;
	execUpdate($query);
}