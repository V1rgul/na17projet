<?php

require_once("connect.php");




//Renvoie la liste des rendez-vous d'un vétérinaire (idVeto)
function getRdvVeterinaire($idVeto){
	$columns = Array("id_rdv", "date", "id_animal", "id_facture", "type");
	$query = "SELECT ".implode(",", $columns)."
			FROM RDV
			WHERE id_veterinaire = ".$idVeto."
			ORDER BY date;";
	return execQuery($query, $columns);
}