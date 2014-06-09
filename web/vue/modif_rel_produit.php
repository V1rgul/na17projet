<?php
require_once("../model/autres.php");
require_once("afficher.php");

if(isset($_POST['nom'])&&!empty($_POST['nom'])){
	
	$nom=$_POST['nom'];
	$id_facture=$_POST['id_facture'];
	$remise=$_POST['remise'];
	$quantite=$_POST['quantite'];

	if ($_POST['op']=='modifier') {
		updateRel_facture_produit($nom, $id_facture, $remise, $quantite);
		echo "modif";
	}
	else if ($_POST['op']=='ajouter') {
		addRel_facture_produit($nom, $id_facture, $remise, $quantite);
		echo "ajouter";
	}
}
else{
	$nom=$_GET['id'];
	$id_facture=$_GET['id_parent'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		deleteRel_facture_produit($nom_produit, $id_facture);
		echo "supprimer<br>";
	}
	else{
		if ($op=='modifier') {
			$data=get_produit_de_facture($nom,$id_facture);
			$remise=$data['remise'];
			$quantite=$data['quantite'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				id facture: <?php echo $id_facture; ?>
			<?php if ($op=='ajouter'):?>
				nom: <input type="text" name='nom'><br>
			<?php else:?>
				nom_produit: <?php echo $nom;?> <br>
				<input type="hidden" name='nom' value="<?php echo $nom;?>">
			<?php endif;?>
			remise: <input type="text" name="remise" value="<?php if ($op=='modifier') echo $remise ?>"><br>
			quantite: <input type="number" name="quantite" value="<?php if ($op=='modifier') echo $quantite ?>"><br>
			<input type="hidden" name='id_facture' value="<?php echo $id_facture;?>">
			<input type="hidden" name='op' value="<?php echo $op;?>">
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 