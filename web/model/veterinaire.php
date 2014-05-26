<?php
require_once("connect.php");
include "requetes.php";

$columns1 = Array("nom", "prenom");
$columns2 = Array("id_veterinaire", "nom", "prenom", "email", "adresse_num", "adresse_rue", "adresse_cp", "adresse_ville", "num_tel");
$columns3 = Array("id_rdv", "date", "id_animal", "id_facture", "type");
//$columns3 = Array("id_rdv", "date", "id_animal", "id_veterinaire", "id_facture", "type"); PAS OBLIGE DE TOUS PRENDRE DANS LA VUE :)

$query1 = getVeterinaires("nom", "prenom");
$query2 = getVeterinairesAll();
$query3 = getRdvGBVeterinaires(1);

//TODO A mettre dans la vue !
function displayListe($ligne, $columns){
	echo "<table border='1'>";
	foreach($columns as $colName)
	{
		echo "<th>$colName</th>";
	}
	foreach($ligne as $col)
	{
		echo "<tr>";
		foreach($col as $element)
		{
			echo "<td>$element</td>";
		}
		echo "</tr>";
		echo "<br/>";
	}
	echo "</table>";
}

$ligne1 = execQuery($query1, $columns1);
displayListe($ligne1, $columns1);

$ligne2 = execQuery($query2, $columns2);
displayListe($ligne2, $columns2);

$ligne3 = execQuery($query3, $columns3);
displayListe($ligne3, $columns3);

