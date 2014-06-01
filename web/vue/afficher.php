<?php
/*
 *  Afficher un liste
 */
function displayListe($ligne, $columns){
    echo "<table border='1'>\n";
    echo "<thead>\n";

    foreach($columns as $colName)
    {
        echo "<th>\t$colName</th>\n";
    }
    echo "</thead>\n";
    echo "<tbody>\n";
    foreach($ligne as $col)
    {
        echo "\t<tr>\n";
        foreach($col as $element)
        {
            echo "\t\t<td>$element</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>";
}

/*
 *  Afficher une liste avec ces bouttons pour la modification
    $columns            le premier columns est id (idclient/idAnimal... etc)
    $targetModif        le nom de la page de modification
    $detail             le nom de detail ('rdv' d'un client / 'animal' d'un client)
    $targetDetail       le nom de lage de detail

    Ex: $targetModif='clientModif';
        $detail=Array('rendez-vous','animaux');
        $target=Array('rdvClient','animauxClient');

        $targetModif='produitModif';
        $detail='';
        $target='';
*/
function modifListe($ligne,$columns,$targetModif,$detail,$targetDetail){
    echo "<table border='1'>\n";
    echo "<thead>\n";
    foreach($columns as $colName)
    {
        echo "\t<th>$colName</th>\n";
    }
    echo "</thead>\n";
    echo "<tbody>\n";
    foreach($ligne as $col)
    {
        echo "\t<tr>\n";
        foreach($col as $element)
        {
            echo "\t\t<td>$element</td>\n";
        }
        $contents=array_values($col);
        $id=$contents[0];
        echo "\t\t<td><a href='".$targetModif.".php?id=$id&&op=modifier'><button>modifier</button></a></td>\n";
        echo "\t\t<td><a href='".$targetModif.".php?id=$id&&op=supprimer'><button>supprimer</button></a></td>\n";
        if($detail!=''){
            echo "\t\t<td>";
            for ($i=0; $i < count($detail); $i++) { 
                echo "<a href='".$targetDetail[$i].".php?id=$id'><button>Voir ses $detail[$i]</button></a>\n";
            }
            echo "\t\t</td>";
            
        }
        echo "\t</tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>\n";
}