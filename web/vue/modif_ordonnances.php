<?php
require_once("../model/client.php");
require_once("afficher.php");
include("include.php");

if(isset($_POST['id_ordonnance'])&&!empty($_POST['id_ordonnance'])){
	$id_ordonnance=$_POST['id_ordonnance'];
	$id_veterinaire=$_POST['id_veterinaire'];

	if ($_POST['op']=='modifier') {
		updateOrdonnanceAnimal($id_ordonnance, $id_veterinaire);
		operationSuccess();
	}
	else if ($_POST['op']=='ajouter') {
		addOrdonnanceAnimal($id_veterinaire);
		operationSuccess();
	}
}
else{
	$id_ordonnance=$_GET['id'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		deleteOrdonnance($id_ordonnance);
		operationSuccess();
	}
	else{
		if ($op=='modifier') {
			$data=getOrdonnance($id_ordonnance);
			$id_ordonnance=$data['id_ordonnance'];
			$id_veterinaire=$data['id_veterinaire'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_ordonnance ?><br>

			id_veterinaire:<input type="number" name="id_veterinaire" value="<?php if ($op=='modifier') echo $id_veterinaire;?>"> <br>
			
			<input type="hidden" name="id_ordonnance" value="<?php echo $id_ordonnance;?>"> 
			<input type="hidden" name='op' value="<?php echo $op;?>" >
			
			<?php controlesPopup() ?>
		</form>

<?php } } 
