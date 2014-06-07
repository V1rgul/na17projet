<?php
require_once("../model/client.php");
require_once("afficher.php");

if(isset($_POST['id_rdv'])&&!empty($_POST['id_rdv'])){

	$id_rdv=$_POST['id_rdv'];
	$date=$_POST['date'];
	$id_animal=$_POST['id_animal'];
	$id_veterinaire=$_POST['id_veterinaire'];
	$id_facture=$_POST['id_facture'];
	$type=$_POST['type'];

	if ($_POST['op']=='modifier') {
		updateRdvAnimal($id_rdv, $date, $id_animal,$id_veterinaire,$id_facture, $type);
		echo "modifier<br>";
	}
	else if ($_POST['op']=='ajouter') {
		addRdvAnimal($date, $id_animal,$id_veterinaire,$id_facture, $type);
		echo "ajouter<br>";
	}
}
else{
	$id_rdv=$_GET['id'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		//TODO
		echo "supprimer<br>";
	}
	else{
		if ($op=='modifier') {
			$data=getRdv($id_rdv);
			$date=$data['date'];
			$id_animal=$data['id_animal'];
			$id_veterinaire=$data['id_veterinaire'];
			$id_facture=$data['id_facture'];
			$type=$data['type'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_animal ?><br>

			date:<input type="date" name="date" value="<?php if ($op=='modifier') echo $date;?>"><br>
			id_animal:<input type="number" name="id_animal" value="<?php if ($op=='modifier') echo $id_animal;?>"><br>
			id_veterinaire:<input type="number" name="id_veterinaire" value="<?php if ($op=='modifier') echo $id_veterinaire;?>"><br>
			id_facture:<input type="number" name="id_facture" value="<?php if ($op=='modifier') echo $id_facture;?>"><br>
			type:<select name="type">
				  <option value="consultation" <?php if ($op=='modifier'&& $type=='consultation') echo 'selected';?> >consultation</option>
				  <option value="intervention" <?php if ($op=='modifier'&& $type=='intervention') echo 'selected';?> >intervention</option>
				  <option value="consultationEtIntervention" <?php if ($op=='modifier'&& $type=='consultationEtIntervention') echo 'selected';?> >consultationEtIntervention</option>
				</select><br>

			<input type="hidden" name='id_rdv' value="<?php echo $id_rdv;?>" >
			<input type="hidden" name='op' value="<?php echo $op;?>" >
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 