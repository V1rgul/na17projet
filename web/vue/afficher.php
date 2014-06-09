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
        echo("Table vide ! <a href='".$targetModif.".php?id=".$id_parent."&op=ajouter'><button>ajouter</button></a>");
        return ;
    }
    echo "<table border='1'>\n";
    echo "<thead>\n";
    foreach($data[0] as $key => $val)
    {
        echo "<th>$key</th>\n";
    }
    echo "<th colspan='".($detail==''?2:3)."'><a href='".$targetModif.".php?id=".$id_parent."&op=ajouter'><button>ajouter</button></a></th>\n";
    echo "</thead>\n";
    echo "<tbody>\n";
    foreach($data as $ligne)
    {
        echo "<tr>\n";
        foreach($ligne as $key =>$val)
        {
            echo "<td>$val</td>\n";
        }
        $contents=array_values($ligne);
        $id=$contents[0];
        echo "<td><a href='".$targetModif.".php?id=$id&&op=modifier'><button>modifier</button></a></td>\n";
        echo "<td><a href='".$targetModif.".php?id=$id&&op=supprimer'><button>supprimer</button></a></td>\n";
        if($detail!=''){
            echo "<td>";
            for ($i=0; $i < count($detail); $i++) { 
                echo "<a href='".$targetDetail[$i].".php?id=$id&&op=detail'><button>Voir ses $detail[$i]</button></a>\n";
            }
            echo "</td>";
            
        }
        echo "</tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>\n";
}