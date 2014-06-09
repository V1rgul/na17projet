<?php
include("header.php");

require_once("../model/autres.php");
require_once("afficher.php");
$id_ordonnance=$_GET['id'];

displayListe(getProduitsOrdonnance($id_ordonnance));

include("footer.php");