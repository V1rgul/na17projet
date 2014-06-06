<?php
include("header.php");

require_once("../model/autres.php")
require_once("afficher.php");
$id_ordonnances=$_GET['id'];

displayListe(getProduitsOrdonnance($id_ordonnances),$columns);

include("footer.php");