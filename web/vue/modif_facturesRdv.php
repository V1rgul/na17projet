<?php
require_once("../model/client.php");
require_once("afficher.php");
include("include.php");

if(isset($_POST['id_rdv'])&&!empty($_POST['id_rdv'])){

	$id_rdv=$_POST['id_rdv'];
	$id_employe=$_POST['id_employe'];
	$date_payment=$_POST['date_payment'];
	$paye=isset($_POST['paye'])?1:0;
	$mode=$_POST['mode'];
	
	echo("Before query<br />");
	addFactureRdv($id_rdv, $date_payment, $paye, $mode, $id_employe);
	echo("After query<br />");
	operationSuccess();

}
else{
	$id_rdv=$_GET['id_rdv'];
	$op=$_GET['op'];

?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			id_employe:<input type="number" name="id_employe" value="<?php if ($op=='modifier') echo $id_employe; ?>"><br>
			date_payment:<input type="date" name="date_payment" value="<?php if ($op=='modifier') echo $date_payment; ?>"><br>
			paye:<input type="checkbox" name="paye" <?php if ($op=='modifier'&& $paye) echo "checked"; ?> ><br>
			mode:<select name="mode">
				  <option value="especes" <?php if ($op=='modifier'&& $mode=='especes') echo 'selected';?> >especes</option>
				  <option value="carteBleue" <?php if ($op=='modifier'&& $mode=='carteBleue') echo 'selected';?> >carteBleue</option>
				  <option value="cheque" <?php if ($op=='modifier'&& $mode=='cheque') echo 'selected';?> >cheque</option>
				</select><br>
			<input type="hidden" name='id_rdv' value="<?php echo $id_rdv; ?>">
			
			<?php controlesPopup(); ?>
		</form>

<?php
} 