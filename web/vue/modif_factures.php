<?php
require_once("../model/client.php");
require_once("afficher.php");

if(isset($_POST['id_facture'])&&!empty($_POST['id_facture'])){
	$id_facture=$_POST['id_facture'];
	$date_payment=$_POST['date_payment'];
	$paye=isset($_POST['paye'])?1:0;
	$mode=$_POST['mode'];
	$id_employe=$_POST['id_employe'];

	$keyVals=Array($id_facture);
	$values=Array($id_facture,$date_payment,$paye,$mode,$id_employe);
	if ($_POST['op']=='modifier') {
		updateFactureAnimal($id_facture, $date_payment, $paye, $mode, $id_employe);
		echo "modifier<br>";
	}
	else if ($_POST['op']=='ajouter') {
		addFactureAnimal($date_payment, $paye, $mode, $id_employe);
		echo "ajouter<br>";
	}
}
else{
	$id_facture=$_GET['id'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		//TODO
		echo "supprimer reussit!<br>";
	}
	else{
		if ($op=='modifier') {
			$data=getFacture($id_facture);
			$date_payment=$data['date_payment'];
			$paye=$data['paye'];
			$mode=$data['mode'];
			$id_employe=$data['id_employe'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_facture ?><br>
			date_payment:<input type="date" name="date_payment" value="<?php if ($op=='modifier') echo $date_payment;?>"><br>
			paye:<input type="checkbox" name="paye" value="<?php if ($op=='modifier'&& $paye) echo "checked";?>" ><br>
			mode:<select name="mode">
				  <option value="espèces" <?php if ($op=='modifier'&& $mode=='espèces') echo 'selected';?> >especes</option>
				  <option value="carteBleue" <?php if ($op=='modifier'&& $mode=='carteBleue') echo 'selected';?> >carteBleue</option>
				  <option value="chèque" <?php if ($op=='modifier'&& $mode=='chèque') echo 'selected';?> >cheque</option>
				</select><br>
			<input type="hidden" name="id_employe" value="<?php echo $id_employe;?>">
			<input type="hidden" name='id_facture' value="<?php echo $id_facture;?>">
			<input type="hidden" name='op' value="<?php echo $op;?>" >
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 