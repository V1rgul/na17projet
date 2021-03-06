<?php
require_once("../model/autres.php");
require_once("afficher.php");
include("include.php");

if(isset($_POST['nom'])&&!empty($_POST['nom'])){
	
	if(!empty($_POST['nom'])) $nom_produit=$_POST['nom'];
	if(!empty($_POST['id_ordonnance'])) $id_ordonnance=$_POST['id_ordonnance'];
	if(!empty($_POST['quantite'])) $quantite=$_POST['quantite'];

	if ($_POST['op']=='modifier') {
		updateProduitOrdonnance($nom_produit, $id_ordonnance, $quantite);
		operationSuccess();
	}
	else if ($_POST['op']=='ajouter') {
		addProduitOrdonnance($nom_produit, $id_ordonnance, $quantite);
		operationSuccess();
	}
}
else{
	$nom=$_GET['id'];
	$id_ordonnance=$_GET['id_parent'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		deleteProduitOrdonnance($nom, $id_ordonnance);
		operationSuccess();
	}
	else{
		if ($op=='modifier') {
			$data=getProduitOrd($id_ordonnance,$nom);
			$quantite=$data['quantite'];
			$prix_unitaire=$data['prix_unitaire'];
		}	
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='ajouter'):?>
				nom: <input type="text" name='nom'><br>
			<?php else:?>
				nom de produit: <?php echo $nom?><br>
				<input type="hidden" name='nom' value="<?php echo $nom;?>">
			<?php endif;?>
			quantite: <input type="number" name="quantite" value="<?php if ($op=='modifier') echo $quantite ?>"><br>
			<input type="hidden" name='op' value="<?php echo $op;?>">
			<input type="hidden" name='id_ordonnance' value="<?php echo $id_ordonnance;?>">
			
			<?php controlesPopup() ?>
		</form>

<?php } } 