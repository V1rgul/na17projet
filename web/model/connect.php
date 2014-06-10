<?php

// Usage : require_once("connect.php");

$PARAM_hote='172.22.0.204'; // tuxa.sme.utc
$PARAM_port='5432';
$PARAM_nom_bd='dbnf17p165';
$PARAM_utilisateur='nf17p165';
$PARAM_mot_passe='Y0dBxcA4';

$GLOBALS["BDD_ERROR"] = FALSE;

try {
	$GLOBALS["BDD_CONNECTION"] = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	// echo('Connection reussie !<br/>');
} catch(Exception $e) {
	echo('Erreur : '.$e->getMessage().'<br />');
	echo('N° : '.$e->getCode());
	die();
}

/*
Exécute une reqûete SQL
*/
function execQuery($query, $columns){
	try {
		$response=$GLOBALS["BDD_CONNECTION"]->query($query);
		$err=$GLOBALS["BDD_CONNECTION"]->errorInfo();
		if (!empty($err[2])) {
			echo "error <pre>query= ".$query."</pre><br>";
			echo "<pre>".$err[2]."</pre><br>";
			$GLOBALS["BDD_ERROR"] = TRUE;
		}
		return constructArrayFromResponse($response, $columns);
	} catch(Exception $e) {
		echo('Erreur : <pre>'.$e->getMessage().'</pre><br />');
		echo('N° : <pre>'.$e->getCode().'</pre>');
		$GLOBALS["BDD_ERROR"] = TRUE;
		die();
	}
}
function execUpdate($query){
	try {
		$GLOBALS["BDD_CONNECTION"]->query($query);
		$err=$GLOBALS["BDD_CONNECTION"]->errorInfo();
		if (!empty($err[2])) {
			echo "error <pre>query= ".$query."</pre><br>";
			echo "<pre>".$err[2]."</pre><br>";
			$GLOBALS["BDD_ERROR"] = TRUE;
		}
	} catch(Exception $e) {
		echo('Erreur : <pre>'.$e->getMessage().'</pre><br />');
		echo('N° : <pre>'.$e->getCode().'</pre>');
		$GLOBALS["BDD_ERROR"] = TRUE;
	}	
}

/*
Construit un tableau avec la requête SQL
*/
function constructArrayFromResponse($response, $columns){
	$r = array();
	while($line = $response->fetch(PDO::FETCH_OBJ)){
		$l = array();
		foreach ($columns as $c) {
			$l[$c] = $line->$c;
		}
		$r[] = $l;
	}
	return $r;
}

