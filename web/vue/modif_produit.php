<?php
require_once("../model/autres.php");
require_once("afficher.php");
include("include.php");

if(isset($_POST['nom'])&&!empty($_POST['nom'])){
	
	$nom=$_POST['nom'];
	$quantite=$_POST['quantite'];
	$prix_unitaire=$_POST['prix_unitaire'];

	if ($_POST['op']=='modifier') {
		updateProduit($nom, $quantite, $prix_unitaire);
		operationSuccess();
	}
	else if ($_POST['op']=='ajouter') {
		addProduit($nom,$quantite,$prix_unitaire);
		operationSuccess();
	}
}
else{
	$nom=$_GET['id'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		deleteProduit($nom);
		operationSuccess();
	}
	else{
		if ($op=='modifier') {
			$data=getProduit($nom);
			$quantite=$data['quantite'];
			$prix_unitaire=$data['prix_unitaire'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='ajouter'):?>
				nom: <input type="text" name='nom'><br>
			<?php else:?>
				<input type="hidden" name='nom' value="<?php echo $nom;?>">
			<?php endif;?>
			quantite: <input type="number" name="quantite" value="<?php if ($op=='modifier') echo $quantite ?>"><br>
			prix_unitaire: <input type="text" name="prix_unitaire" value="<?php if ($op=='modifier') echo $prix_unitaire ?>"><br>
			<input type="hidden" name='op' value="<?php echo $op;?>">
			
			<?php controlesPopup() ?>
		</form>

<?php } } 