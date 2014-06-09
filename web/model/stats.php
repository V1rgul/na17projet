<?php

require_once("connect.php");



//Renvoie le nombre de prescriptions d'un médicament (d'un produit)
function getNbPrescriptionsGBProduit(){
	$columns = Array("nom_produit", "nbprescriptions");
	$query ="SELECT nom_produit, count(*) AS NbPrescriptions
			FROM Prescription
			GROUP BY nom_produit
			ORDER BY NbPrescriptions;";
	return execQuery($query, $columns);
}


//Renvoie le nombre des rendez-vous par animal
function getNbPRdvGBAnimal(){
	$columns = Array("id_animal", "nbrdv");
	$query ="SELECT id_animal, count(id_rdv) AS NbRDV
			FROM RDV
			GROUP BY id_animal
			ORDER BY NbRDV DESC;";
	return execQuery($query, $columns);
}


//Renvoie le nombre des rendez-vous par client
function getNbPRdvGBClient(){
	$columns = Array("id_client", "nbrdv");
	$query ="SELECT id_client, count(id_rdv) AS NbRDV
			FROM
				(SELECT id_rdv, id_animal
				FROM RDV) AS R,
				(SELECT A.id_animal, C.id_client
				FROM Animal A, Client C
				WHERE A.id_client = C.id_client) AS JOINTURE_ANIMAL_CLIENT
			WHERE R.id_animal = JOINTURE_ANIMAL_CLIENT.id_animal
			GROUP BY id_client
			ORDER BY NbRDV DESC;";
	return execQuery($query, $columns);
}


//Renvoie le l'age moyen des animaux soignés avec un médicament (produit)
function getAgeOfAnimalCaredByProduct(){
	$columns = Array("nom_produit", "age_moyen");
	$query ="SELECT AGE_OF_EACH_ANIMAL.nom_produit, avg(AGE_OF_EACH_ANIMAL.age_animal) age_moyen
			FROM
				(SELECT P.nom_produit, EXTRACT (YEAR FROM age(A.date_naissance)) age_animal
				FROM Animal A, Rdv R, Ordonnances O, Prescription P
				WHERE A.id_animal = R.id_animal
				AND R.id_veterinaire = O.id_veterinaire
				AND O.id_ordonnance = P.id_ordonnance) AS AGE_OF_EACH_ANIMAL
			GROUP BY AGE_OF_EACH_ANIMAL.nom_produit
			ORDER BY age_moyen DESC;";
	return execQuery($query, $columns);
}


//Renvoie le montant moyen des factures
function getAvgOfPriceByFacture(){
	$columns=Array("avg");
	$query="SELECT avg(PRIX_TOTAL.prix_total_par_facture)
			FROM
				(
					(SELECT Re.id_facture, sum(P.prix_unitaire * Re.quantite) + PRIX_INTERV.prix_intervention - Re.remise  AS prix_total_par_facture
					FROM Produit P, Rel_facture_produit Re,

						(SELECT F.id_facture, sum(Ra.prix_intervention) as prix_intervention
						FROM Facture F, RDV R, Animal A, Race Ra
						WHERE F.id_facture = R.id_facture
						AND R.id_animal = A.id_animal
						AND A.race = Ra.race
						AND R.type = 'intervention'
						GROUP BY F.id_facture) AS PRIX_INTERV

					WHERE P.nom = Re.nom_produit
					AND Re.id_facture = PRIX_INTERV.id_facture
					GROUP BY Re.id_facture, PRIX_INTERV.prix_intervention, Re.remise)

					UNION

					(SELECT Re.id_facture, sum(P.prix_unitaire * Re.quantite) + PRIX_PRESTATIONS.prix_prestation - Re.remise  AS prix_total_par_facture
					FROM Produit P, Rel_facture_produit Re,

					(SELECT F.id_facture, (sum(Ra.prix_intervention) + sum(E.prix_consultation)) as prix_prestation
						FROM Facture F, RDV R, Animal A, Race Ra, Especes E
						WHERE F.id_facture = R.id_facture
						AND R.id_animal = A.id_animal
						AND A.race = Ra.race
						AND Ra.especes = E.especes
						AND R.type = 'consultationEtIntervention'
						GROUP BY F.id_facture) AS PRIX_PRESTATIONS

					WHERE P.nom = Re.nom_produit
					AND Re.id_facture = PRIX_PRESTATIONS.id_facture
					GROUP BY Re.id_facture, PRIX_PRESTATIONS.prix_prestation, Re.remise)

					UNION

					(SELECT Re.id_facture, sum(P.prix_unitaire * Re.quantite) + PRIX_CONSULT.prix_consultation - Re.remise  AS prix_total_par_facture
					FROM Produit P, Rel_facture_produit Re,

						(SELECT F.id_facture, sum(E.prix_consultation) as prix_consultation
						FROM Facture F, RDV R, Animal A, Race Ra, Especes E
						WHERE F.id_facture = R.id_facture
						AND R.id_animal = A.id_animal
						AND A.race = Ra.race
						AND Ra.especes = E.especes
						AND R.type = 'consultation'
						GROUP BY F.id_facture) AS PRIX_CONSULT

					WHERE P.nom = Re.nom_produit
					AND Re.id_facture = PRIX_CONSULT.id_facture
					GROUP BY Re.id_facture, PRIX_CONSULT.prix_consultation, Re.remise)
				) AS PRIX_TOTAL
		;";
	return execQuery($query, $columns);
}


//Renvoie le nombre de médicaments (produits) prescrits par vétérinaire
function getNbMedicamentPrescritsByVeterinaire(){
	$columns = Array("id_veterinaire", "nb_produit_prescrit");
	$query ="SELECT O.id_veterinaire, sum(P.quantite) AS nb_produit_prescrit
			FROM Prescription P, Ordonnances O
			WHERE P.id_ordonnance = O.id_ordonnance
			GROUP BY id_veterinaire
			ORDER BY nb_produit_prescrit DESC;";
	return execQuery($query, $columns);
}
