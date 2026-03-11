<?php
// Récupération du contenu de la requete 
//Affichage du tableau des résultats
        $reponse = mysqli_query($connexion,$requete);
        if ($reponse) 
            {
                $nombreEnregistrement = mysqli_num_rows($reponse);
                echo "<p>Le nombre d'enregistrements du résultat de cette requête est de : $nombreEnregistrement </p>";
                $recuperationNomColonne=true;
                $ligneTableau="ligneImpaire";
                // Création de la table résultat
                echo "<table border=1>";
                while ($donnees = mysqli_fetch_array($reponse)) // lecture des enregistrements un à un tant qu'il y en a
                    {   // Affichage entête de colonnes : nom, population
                        if ($recuperationNomColonne==true)
                            {   
                                echo "<tr>";
                                foreach ($donnees as $key => $value) 
                                {   // utilisation des données de clés non numériques
                                    if (!is_numeric ($key))                
                                        echo "<th>$key</th>";
                                }
                                echo "</tr>";
                                $recuperationNomColonne=false;
                                reset($donnees);// Remise à 0 de la lecture du résultat de la requete
                            }
                        echo "<tr class=$ligneTableau>";
                        //Affichage d'une nouvelle ligne
                        foreach ($donnees as $key => $value) 
                            {
                                if (!is_numeric ($key))
                                    {
                                        if ($value==NULL) // gestion des valeurs NULL 
                                            echo "<td>"."  "."</td>";
                                        else
                                            echo "<td>{$value}</td>";
                                    }
                            }
                        echo "</tr>";
                        //Permettra le changement d'apparence de la ligne du tableau : grisée ou pas
                        if ($ligneTableau=="lignePaire")
                            $ligneTableau="ligneImpaire";
                        else
                            $ligneTableau="lignePaire";
                    }//while
                echo "</table>"; //fin de la table
            }//fin si 
        else 
            echo "<p>Le resultat de la requête est vide.</p>";
?>