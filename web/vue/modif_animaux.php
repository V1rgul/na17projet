<?php
require_once("../model/connect.php");
require_once("../model/requetes.php");
require_once("afficher.php");

$table='Animal';
$columns = Array('id_animal','nom','code','taille','poids','data_naissance','race','id_client');
$keyCols=Array('id_animal');

if(isset($_POST['id_animal'])&&!empty($_POST['id_animal'])){
	$id_animal=$_POST['id_animal'];
	$nom=$_POST['nom'];
	$code=$_POST['code'];
	$taille=$_POST['taille'];
	$poids=$_POST['poids'];
	$data_naissance=$_POST['data_naissance'];
	$race=$_POST['race'];
	$id_client=$_POST['id_client'];

	$keyVals=Array($id_animal);
	$values=Array($id_animal,$nom,$code,$taille,$poids,$data_naissance,$race,$id_client);
	if ($_POST['op']=='modifier') {
		$requete=updateColsWithKeys($table,$columns,$values,$keyCols,$keyVals);
		execQueryNoResponse($requete);
	}
	else if ($_POST['op']='ajouter') {
		echo "ajouter";
	}
}
else{
	$id_animal=$_GET['id'];
	$op=$_GET['op'];
	$keyVals=Array($id_animal);
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

			$id_animal=$ligne['id_animal'];
			$nom=$ligne['nom'];
			$code=$ligne['code'];
			$taille=$ligne['taille'];
			$poids=$ligne['poids'];
			$data_naissance=$ligne['data_naissance'];
			$race=$ligne['race'];
			$id_client=$ligne['id_client'];
		}	
		else if($op=='ajouter'){
		}
?>
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
			<?php if ($op=='modifier') echo "id:".$id_animal ?><br>

			nom:<input type="text" name="nom" value="<?php if ($op=='modifier') echo $nom;?> "> <br>
			code:<input type="text" name="code" value="<?php if ($op=='modifier') echo $code;?> "> <br>
			taille:<input type="text" name="taille" value="<?php if ($op=='modifier') echo $taille;?> "> <br>
			poids:<input type="text" name="poids" value="<?php if ($op=='modifier') echo $poids;?> "> <br>
			data_naissance:<input type="text" name="data_naissance" value="<?php if ($op=='modifier') echo $data_naissance;?> "> <br>
			race:<input type="text" name="race" value="<?php if ($op=='modifier') echo $race;?> "> <br>
			id_client:<input type="text" name="id_client" value="<?php if ($op=='modifier') echo $id_client;?> "> <br>

			<input type="hidden" name='id_animal' value="<?php echo $id_animal;?> >
			<input type="hidden" name='op' value="<?php echo $op;?> >
			<input type="submit" value="Send">
			<input type="reset" value="Reset">
		</form>

<?php } } 