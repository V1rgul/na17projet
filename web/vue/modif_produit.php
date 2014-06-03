<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Produit';
$columns = Array("nom","quantite", "prix_unitaire");
$keyCols=Array('nom');

if(isset($_POST['nom'])&&!empty($_POST['nom'])){
	
	$nom=$_POST['nom'];
	$quantite=$_POST['quantite'];
	$prix_unitaire=$_POST['prix_unitaire'];

	$keyVals=Array($nom);
	$values=Array($nom,$quantite,$prix_unitaire);
	if ($_POST['op']=='modifier') {
		$requete=updateColsWithKeys($table,$columns,$values,$keyCols,$keyVals);
		execQueryNoResponse($requete);
	}
	else if ($_POST['op']=='ajouter') {
		echo "ajouter";
	}
}
else{
	$nom=$_GET['id'];
	$op=$_GET['op'];
	$keyVals=Array($nom);
	if ($op=='supprimer') {
		$requete=deleteRowWithKeys($table,$keyCols,$keyVals);
		execQueryNoResponse($requete);
		echo "supprimer reussit!<br>";
	}
	else{
		if ($op=='modifier') {
			$requete=getById($table,$keyCols,$keyVals);
			$ligne=execQuery($requete,$columns);
			$ligne=$ligne[0];
			$nom=$ligne['nom'];
			$quantite=$ligne['quantite'];
			$prix_unitaire=$ligne['prix_unitaire'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			quantite: <input type="number" name="quantite" value="<?php if ($op=='modifier') echo $quantite ?>"><br>
			prix_unitaire: <input type="text" name="prix_unitaire" value="<?php if ($op=='modifier') echo $prix_unitaire ?>"><br>
			
			<input type="hidden" name='nom' value="<?php echo $nom;?>">
			<input type="hidden" name='op' value="<?php echo $op;?>">
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 