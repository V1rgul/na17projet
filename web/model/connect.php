<?php

$PARAM_hote='172.22.0.204'; // tuxa.sme.utc
$PARAM_port='5432';
$PARAM_nom_bd='dbnf17p165';
$PARAM_utilisateur='nf17p165';
$PARAM_mot_passe='Y0dBxcA4';
$connexion;

try {
	$connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	echo('Connection reussie !');
} catch(Exception $e) {
	echo('Erreur : '.$e->getMessage().'<br />');
	echo('N° : '.$e->getCode());
}