<?php
require_once("../model/autres.php");
require_once("afficher.php");
include("include.php");

if(isset($_POST['nom'])&&!empty($_POST['nom'])){
	
	$nom=$_POST['nom'];
	$id_facture=$_POST['id_facture'];
	$remise=$_POST['remise'];
	$quantite=$_POST['quantite'];
	$id_ordonnance=$_POST['id_ordonnance'];

	if ($_POST['op']=='modifier') {
		updateRel_facture_produit($nom, $id_facture, $remise, $quantite);
		operationSuccess();
	}
	else if ($_POST['op']=='ajouter') {
		addRel_facture_produit($nom, $id_facture, $remise, $quantite);
		operationSuccess();
	}
}else if(isset($_POST['id_ordonnance'])&&!empty($_POST['id_ordonnance'])){
	
	$id_facture=$_POST['id_facture'];
	$remise=$_POST['remise'];
	$id_ordonnance=$_POST['id_ordonnance'];

	copyFromPrescriptionsToFacture($id_ordonnance, $id_facture, $remise);
	operationSuccess();
	
}
else{
	$nom=$_GET['id'];
	$id_facture=$_GET['id_parent'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		deleteRel_facture_produit($nom, $id_facture);
		operationSuccess();
	}
	else{
		if ($op=='modifier') {
			$data=get_produit_de_facture($nom,$id_facture);
			$remise=$data['remise'];
			$quantite=$data['quantite'];
		}	
		

		if($op=='ajouter'){
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			id_ordonnance: <input type="number" name="id_ordonnance" ><br>
			remise: <input type="text" name="remise"><br>
			<input type="hidden" name='op' value="<?php echo $op;?>">
			<input type="hidden" name='id_facture' value="<?php echo $id_facture;?>">
			<?php controlesPopup() ?>
		</form>
<?php
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				id facture: <?php echo $id_facture; ?> <br>
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
			
			<?php controlesPopup() ?>
		</form>

<?php } } 