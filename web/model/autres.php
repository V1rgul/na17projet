<?php

require_once("connect.php");

function getProduits(){
	$columns = Array("nom", "quantite", "prix_unitaire");
	$query = "SELECT ".implode(",", $columns)."
			FROM Produit
			ORDER BY nom;";
	return execQuery($query, $columns);
}
function addProduit($nom, $quantite, $prix_unitaire){
	$query = "INSERT INTO Produit (nom, quantite, prix_unitaire)
			VALUES (".$nom.",".$quantite.",".$prix_unitaire.")";
	execUpdate($query);
}
function updateProduit($nom, $quantite, $prix_unitaire){
	$query = "UPDATE Produit
			  WHERE nom=".$nom."
			  SET quantite=".$quantite.", prix_unitaire=".$prix_unitaire;
	execUpdate($query);
}


//Renvoie la liste des produit d'une ordonnace (idOrdonnace,)
function getProduitsOrdonnance($id_ordonnance){
	$columns = Array("nom", "quantite", "prix_unitaire");
	$query = "SELECT Produit.nom, Prescription.quantite, Produit.prix_unitaire
		FROM Produit, Prescription
		WHERE Produit.nom = Prescription.nom_produit AND Prescription.id_ordonnance=".$id_ordonnance."
		ORDER BY Produit.nom;";
	return execQuery($query, $columns);
}
function addProduitOrdonnance($nom_produit, $id_ordonnance, $quantite){
	$query = "INSERT INTO Prescription (nom_produit, id_ordonnance, quantite)
			VALUES (".$nom_produit.",".$id_ordonnance.",".$quantite.")";
	execUpdate($query);
}
function updateProduitOrdonnance($nom_produit, $id_ordonnance, $quantite){
	$query = "UPDATE Prescription
			  WHERE nom_produit=".$nom_produit.", id_ordonnance=".$id_ordonnance."
			  SET quantite=".$quantite;
	execUpdate($query);
}