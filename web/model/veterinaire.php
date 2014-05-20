<?php
require_once("connect.php");


function listeVeterinaires(){
	return selectFromColumns("veterinaire", Array("nom", "prenom"));
}





//print_r(listeVeterinaires()); 