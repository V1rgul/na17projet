<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='RDV';
$columns = Array("id_rdv", "date", "id_animal","id_veterinaire","id_facture", "type");
$keyCols=Array('id_rdv');

if(isset($_POST['id_rdv'])&&!empty($_POST['id_rdv'])){

	$id_rdv=$_POST['id_rdv'];
	$date=$_POST['date'];
	$id_animal=$_POST['id_animal'];
	$id_veterinaire=$_POST['id_veterinaire'];
	$id_facture=$_POST['id_facture'];
	$type=$_POST['type'];

	$keyVals=Array($id_rdv);
	$values=Array($id_rdv,$date,$id_animal,$id_veterinaire,$id_facture,$type);
	if ($_POST['op']=='modifier') {
		$requete=updateColsWithKeys($table,$columns,$values,$keyCols,$keyVals);
		execQueryNoResponse($requete);
	}
	else if ($_POST['op']=='ajouter') {
		echo "ajouter";
	}
}
else{
	$id_rdv=$_GET['id'];
	$op=$_GET['op'];
	$keyVals=Array($id_rdv);
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

			$date=$ligne['date'];
			$id_animal=$ligne['id_animal'];
			$id_veterinaire=$ligne['id_veterinaire'];
			$id_facture=$ligne['id_facture'];
			$type=$ligne['type'];
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