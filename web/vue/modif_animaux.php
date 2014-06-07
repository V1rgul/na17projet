<?php
require_once("../model/client.php");
require_once("afficher.php");

if(isset($_POST['id_animal'])&&!empty($_POST['id_animal'])){
	$id_animal=$_POST['id_animal'];
	$nom=$_POST['nom'];
	$code=$_POST['code'];
	$taille=$_POST['taille'];
	$poids=$_POST['poids'];
	$date_naissance=$_POST['date_naissance'];
	$race=$_POST['race'];
	$id_client=$_POST['id_client'];

	if ($_POST['op']=='modifier') {
		updateAnimalClient($id_animal, $id_client, $nom, $code, $taille, $poids, $date_naissance, $race);
		echo "modifier";
	}
	else if ($_POST['op']=='ajouter') {
		addAnimalClient($id_client, $nom, $code, $taille, $poids, $date_naissance, $race);
		echo "ajouter";
	}
}
else{
	$id_animal=$_GET['id'];
	$op=$_GET['op'];
	$keyVals=Array($id_animal);
	if ($op=='supprimer') {
		//TODO
		echo "supprimer<br>";
	}
	else{
		if ($op=='modifier') {
			$data=getAnimaux($id_animal);
			$nom=$data['nom'];
			$code=$data['code'];
			$taille=$data['taille'];
			$poids=$data['poids'];
			$date_naissance=$data['date_naissance'];
			$race=$data['race'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_animal ?><br>

			nom:<input type="text" name="nom" value="<?php if ($op=='modifier') echo $nom;?>"> <br>
			code:<input type="text" name="code" value="<?php if ($op=='modifier') echo $code;?>"> <br>
			taille:<input type="text" name="taille" value="<?php if ($op=='modifier') echo $taille;?>"> <br>
			poids:<input type="text" name="poids" value="<?php if ($op=='modifier') echo $poids;?>"> <br>
			date_naissance:<input type="text" name="date_naissance" value="<?php if ($op=='modifier') echo $date_naissance;?>"> <br>
			race:<input type="text" name="race" value="<?php if ($op=='modifier') echo $race;?>"> <br>

			<input type="hidden" name="id_client" value="<?php echo $id_client;?>"> 
			<input type="hidden" name='id_animal' value="<?php echo $id_animal;?>">
			<input type="hidden" name='op' value="<?php echo $op;?>" >
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 