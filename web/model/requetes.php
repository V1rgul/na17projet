
//////////////////////////////////////////////////////////////////////////
//                                                                      //
//                       DO NOT USE THIS FILE !!!                       //
//                                                                      //
//////////////////////////////////////////////////////////////////////////




<?php


/*
--------------------------------------
Requetes générales
--------------------------------------
*/

/*
//Renvoie les cols $columns pour la table $table
function getCols($table,$columns){
	return " SELECT ".implode(",", $columns).
		   " FROM $table;";
}

//Renvoie tous les cols de la table $table
function getAll($table){
	return "SELECT *
			FROM $table;";
}


//Renvoie une ligne de certaine id de la table $table
function getById($table,$keyCols,$keyVals){
	$requete= 	"SELECT *
				FROM $table
				WHERE $keyCols[0]='$keyVals[0]'";
	for ($i=1; $i < count($keyCols); $i++) { 
		$requete=$requete." AND $keyCols[$i]='$keyVals[$i]'";
	}
	return $requete.";";
}

/*
insert les cols d'une table
*/
function insertColsWithKeys($table,$columns,$values,$keyCols,$keyVals){
	if ((count($columns)!=count($values))||(count($keyCols)!=count($keyVals))) {
		echo('Erreur : '."columns et values n'ont pas la meme taille".'<br />');
		return;
	}
}

/*
Update les cols d'une table
*/
function updateColsWithKeys($table,$columns,$values,$keyCols,$keyVals){
	if ((count($columns)!=count($values))||(count($keyCols)!=count($keyVals))) {
		echo('Erreur : '."columns et values n'ont pas la meme taille".'<br />');
		return;
	}

	$requete="UPDATE $table SET ";
	for ($i=0; $i < count($columns); $i++) {
		if (empty($values[$i])) {
			$values[$i]="NULL";
		}
		else{
			$values[$i]="'$values[$i]'";
		}
		$requete=$requete.$columns[$i]."=$values[$i],";
	}
	$requete=trim($requete,",")." WHERE $keyCols[0]='$keyVals[0]'";
	for ($i=1; $i < count($keyCols); $i++) {
		$requete=$requete." AND $keyCols[$i]='$keyVals[$i]'";
	}
	return $requete.";";
}


//Delete les colonnes de la table $table
function deleteRowWithKeys($table,$keyCols,$keyVals)
{
	if (count($keyCols)!=count($keyVals)) {
		echo('Erreur : '."columns et values n'ont pas la meme taille".'<br />');
		return;
	}

	$requete="DELETE FROM $table WHERE $keyCols[0]=$keyVals[0]";
	for ($i=1; $i < count($keyCols); $i++) { 
		$requete=$requete." AND $keyCols[$i]='$keyVals[$i]'";
	}
	return $requete.";";
}
*/
/*
--------------------------------------
Requetes Getters "GROUP BY"
--------------------------------------
*/




/*
//Renvoie la liste des produit d'une ordonnace (idOrdonnace,)
function getProduitOrdonnance($idOrdonnance){
	return "SELECT *
			FROM Produit
			WHERE nom
			IN(
				SELECT nom_produit
				FROM Prescription
				WHERE id_ordonnances=$idOrdonnance)
			ORDER BY nom;";
}
*/
/*
--------------------------------------
Requetes Statistiques
--------------------------------------
*/

/*
//Renvoie le nombre de prescriptions d'un médicament (d'un produit)
function getNbPrescriptionsGBProduit(){
	return "SELECT nom_produit, count(*) AS NbPrescriptions
			FROM Prescription
			GROUP BY nom_produit
			ORDER BY NbPrescriptions;";
}


//Renvoie le nombre des rendez-vous par animal
function getNbPRdvGBAnimal(){
	return "SELECT id_animal, count(id_rdv) AS NbRDV
			FROM RDV
			GROUP BY id_animal
			ORDER BY NbRDV DESC;";
}


//Renvoie le nombre des rendez-vous par client
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


//Renvoie le l'age moyen des animaux soignés avec un médicament (produit)
function getAgeOfAnimalCaredByProduct(){
	return "SELECT AGE_OF_EACH_ANIMAL.nom_produit, avg(AGE_OF_EACH_ANIMAL.age_animal) age_moyen
			FROM
				(SELECT P.nom_produit, EXTRACT (YEAR FROM age(A.data_naissance)) age_animal
				FROM Animal A, Rdv R, Ordonnances O, Prescription P
				WHERE A.id_animal = R.id_animal
				AND R.id_veterinaire = O.id_veterinaire
				AND O.id_ordonnances = P.id_ordonnances) AS AGE_OF_EACH_ANIMAL
			GROUP BY AGE_OF_EACH_ANIMAL.nom_produit
			ORDER BY age_moyen DESC;";
}


//Renvoie le montant moyen des factures
function getAvgOfPriceByFacture(){
	return "SELECT avg(PRIX_UNITAIRE_QUANTITE.prix_total_par_facture) AS montant_moyen_facture
			FROM
				(SELECT R.id_facture, sum((P.prix_unitaire * R.quantite) - R.remise) AS prix_total_par_facture
				FROM Produit P, Rel_facture_produit R
				WHERE P.nom = R.nom_produit
				GROUP BY R.id_facture) AS PRIX_UNITAIRE_QUANTITE;";
}


//Renvoie le nombre de médicaments (produits) prescrits par vétérinaire
function getNbMedicamentPrescritsByVeterinaire(){
	return "SELECT O.id_veterinaire, sum(P.quantite) AS nb_produit_prescrit
			FROM Prescription P, Ordonnances O
			WHERE P.id_ordonnances = O.id_ordonnances
			GROUP BY id_veterinaire
			ORDER BY nb_produit_prescrit DESC;";
}
*/

