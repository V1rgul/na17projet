<?php
require_once("../model/client.php");
require_once("afficher.php");
include("include.php");

if(isset($_POST['id_client'])&&!empty($_POST['id_client'])){
	$id_client=$_POST['id_client'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$email=$_POST['email'];
	$adresse_num=$_POST['adresse_num'];
	$adresse_rue=$_POST['adresse_rue'];
	$adresse_cp=$_POST['adresse_cp'];
	$adresse_ville=$_POST['adresse_ville'];
	$num_tel=$_POST['num_tel'];

	if ($_POST['op']=='modifier') {
		updateClient($id_client, $nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel);
		operationSuccess();
	}
	else if ($_POST['op']=='ajouter') {
		addClient($nom, $prenom, $email, $adresse_num, $adresse_rue, $adresse_cp, $adresse_ville, $num_tel);
		operationSuccess();
	}
}
else{
	$id_client=$_GET['id'];
	$op=$_GET['op'];
	if ($op=='supprimer') {
		deleteClient($id_client);
		operationSuccess();
	}
	else{
		if ($op=='modifier') {
			$data=getClient($id_client);
			$nom=$data['nom'];
			$prenom=$data['prenom'];
			$email=$data['email'];
			$adresse_num=$data['adresse_num'];
			$adresse_rue=$data['adresse_rue'];
			$adresse_cp=$data['adresse_cp'];
			$adresse_ville=$data['adresse_ville'];
			$num_tel=$data['num_tel'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_client ?><br>
			nom: <input type="text" name="nom" value="<?php if ($op=='modifier') echo $nom;?>"><br>
			prenom: <input type="text" name="prenom" value="<?php if ($op=='modifier') echo $prenom;?>"><br>
			email: <input type="email" name="email" value="<?php if ($op=='modifier') echo $email;?>"><br>
			addresse<br>
			numero: <input type="number" name="adresse_num" value="<?php if ($op=='modifier') echo $adresse_num;?>"><br>
			rue: <input type="text" name="adresse_rue" value="<?php if ($op=='modifier') echo $adresse_rue;?>"><br>
			code postale: <input type="text" name="adresse_cp" value="<?php if ($op=='modifier') echo $adresse_cp;?>"><br>
			ville: <input type="text" name="adresse_ville" value="<?php if ($op=='modifier') echo $adresse_ville;?>"><br>
			numero telephone: <input type="text" name="num_tel" value="<?php if ($op=='modifier') echo $num_tel;?>"><br>
			<input type="hidden" name='id_client' value="<?php echo $id_client;?>">
			<input type="hidden" name='op' value="<?php echo $op;?>">

			<?php controlesPopup() ?>
		</form>

<?php } } 
