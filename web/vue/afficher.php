<?php
/*
 *  Afficher un liste
 */
function displayListe($data){
    if(count($data) == 0){
        echo("Table vide !");
        return ;
    }
    echo "<table border='1'>\n";
    echo "<thead>\n";

    foreach($data[0] as $key => $val)
    {
        echo "<th>$key</th>\n";
    }
    echo "</thead>\n";
    echo "<tbody>\n";
    foreach($data as $ligne)
    {
        echo "<tr>\n";
        foreach($ligne as $key =>$val)
        {
            echo "<td>$val</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>";
}


function filterAndEncode($arr){
    $r = "";
    foreach ($arr as $key => $val) { 
        if( strpos($key, "id") === 0 ){
            $r = $r."&".$key."=".$val;
        }
    }
    return $r;
}
/*
 *  Afficher une liste avec ces bouttons pour la modification
    $targetModif        le nom de la page de modification
    $detail             le nom de detail ('rdv' d'un client / 'animal' d'un client)
    $targetDetail       le nom de lage de detail

    Ex: $targetModif='clientModif';
        $detail=Array('rendez-vous','animaux');
        $target=Array('rdvClient','animauxClient');

        $targetModif='produitModif';
        $detail='';
        $target='';
    Pour recuperer des parametre:   $id=$_GET('id');  ou $id soit idClient soit idAnimal ...etc
                                    $op=$_GET('op');  ou $op est {'ajouter','modifier','supprimer','detail'}
*/
function modifListe($data,$targetModif,$detail,$targetDetail,$id_parent){
    if(count($data) == 0){
        echo("Table vide ! <a href='".$targetModif.".php?id=".$id_parent."&id_parent=$id_parent&op=ajouter' class='add popup'><span class='icons'>a</span> Ajouter</a>");
        return ;
    }
    echo "<table border='1'>\n";
    echo "<thead>\n";
    echo "<tr><th><a href='".$targetModif.".php?id=".$id_parent."&id_parent=$id_parent&op=ajouter' class='add popup'><span class='icons'>a</span></a></th>\n";
    foreach($data[0] as $key => $val)
    {
        echo "<th>$key</th>\n";
    }
    if($detail!='') echo "<th></th>\n";
    echo "</tr></thead>\n";
    echo "<tbody>\n";

    $detailPopup = Array();
    for ($i=0; $i < count($detail); $i++) { 
        $index = strpos($detail[$i], "#");
        if( strpos($detail[$i], "#") === 0 ){
            $detail[$i] = substr($detail[$i], 1);
            $detailPopup[] = TRUE;
        }else 
            $detailPopup[] = FALSE;
    }



    foreach($data as $ligne)    {
        $contents=array_values($ligne);
        $id=$contents[0];
        $idList = filterAndEncode($ligne);

        echo "<tr>\n";
        echo "<td><a href='".$targetModif.".php?id=$id&id_parent=$id_parent&op=modifier' class='edit popup'><span class='icons'>e</span></a>\n";
        echo "<a href='".$targetModif.".php?id=$id&id_parent=$id_parent&op=supprimer' class='delete popup'><span class='icons'>s</span></a></td>\n";
        foreach($ligne as $key =>$val)
        {
            echo "<td>$val</td>\n";
        }
        
        if($detail!=''){
            echo "<td>";
            for ($i=0; $i < count($detail); $i++) { 
                echo "<a href='".$targetDetail[$i].".php?id=$id&id_parent=$id_parent&op=detail".$idList."' class='button".($detailPopup[$i]?" popup":"")."'>".$detail[$i]."</a>\n";
            }
            echo "</td>";
            
        }
        echo "</tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>\n";
}


function retour(){
?>
<a class="button" href="javascript:history.back()" style="display:inline-block;margin-bottom:5px;"><span class='icons'>l</span> retour</a><br />
<?php
}


function controlesPopup(){
?>
    <br />
    <button class="cancel" onclick="window.close();">Annuler</button>
    <button type="reset" class="reset">R&eacute;initialiser</button>
    <button type="submit" class="submit">Envoyer</button>
<?php   
}

// Affiche le resultat d'une opération (Ajout, modification, suppression)
function operationSuccess(){
    if      ( isset($_POST['op']) && $_POST['op'] === "ajouter" )        $op = "Ajout";
    else if ( isset($_POST['op']) && $_POST['op'] === "modifier" )       $op = "Modification";
    else if ( isset($_GET['op'] ) && $_GET['op']  === "supprimer" )      $op = "Supression";
    else                                                                 $op = "Op&eacute;ration";

    if( !$GLOBALS["BDD_ERROR"] ){ ?>
        <script>reloadParent();</script>
        <button onclick="window.close();" class="submit"><?php echo($op) ?> r&eacute;ussi(e) !</button>
    <?php } else{ ?>
        <button onclick="window.close();" class="cancel"><?php echo($op) ?> Echou&eacute;(e) !</button>
    <?php }

}