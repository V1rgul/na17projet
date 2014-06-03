<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Facture';
$columns = Array("id_facture","date_payment","paye","mode","id_employe");
$keyCols=Array('id_facture');

if(isset($_POST['id_facture'])&&!empty($_POST['id_facture'])){
	$id_facture=$_POST['id_facture'];
	$date_payment=$_POST['date_payment'];
	$paye=isset($_POST['paye'])?1:0;
	$mode=$_POST['mode'];
	$id_employe=$_POST['id_employe'];

	$keyVals=Array($id_facture);
	$values=Array($id_facture,$date_payment,$paye,$mode,$id_employe);
	if ($_POST['op']=='modifier') {
		$requete=updateColsWithKeys($table,$columns,$values,$keyCols,$keyVals);
		execQueryNoResponse($requete);
	}
	else if ($_POST['op']='ajouter') {
		echo "ajouter";
	}
}
else{
	$id_facture=$_GET['id'];
	$op=$_GET['op'];
	$keyVals=Array($id_facture);
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

			$date_payment=$ligne['date_payment'];
			$paye=$ligne['paye'];
			$mode=$ligne['mode'];
			$id_employe=$ligne['id_employe'];
		}	
		else if($op=='ajouter'){
		}
	?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_facture ?><br>

			date_payment:<input type="date" name="date_payment" value=<?php if ($op=='modifier') echo $date_payment;?>><br>
			paye:<input type="checkbox" name="paye" value=<?php if ($op=='modifier'&& $paye) echo "checked";?>><br>
			mode:<select name="mode">
				  <option value="espèces" <?php if ($op=='modifier'&& $mode=='espèces') echo 'selected';?> >especes</option>
				  <option value="carteBleue" <?php if ($op=='modifier'&& $mode=='carteBleue') echo 'selected';?> >carteBleue</option>
				  <option value="chèque" <?php if ($op=='modifier'&& $mode=='chèque') echo 'selected';?> >cheque</option>
				</select><br>
			id_employe:<input type="" name="id_employe" value=<?php if ($op=='modifier') echo $id_employe;?>><br>
			<input type="hidden" name='id_facture' value=<?php echo $id_facture;?> >
			<input type="hidden" name='op' value=<?php echo $op;?> >
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 