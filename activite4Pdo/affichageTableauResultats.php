<?php
// affichageTableauResultats.php - Version PDO
// Ce fichier est inclus dans requeteFigee.php pour traiter et afficher les données

try {
    // Exécution de la requête SQL via l'objet PDO $connexion
    $reponseRequete = $connexion->query($requete);

    if ($reponseRequete) {
        // (09) Comptage : Utilisation de rowCount()
        $nombreEnregistrement = $reponseRequete->rowCount();
        echo "<p>Le nombre d'enregistrements du résultat de cette requête est de : $nombreEnregistrement </p>";

        if ($nombreEnregistrement > 0) {
            echo "<table border='1'>";
            
            $enteteAffichee = false;
            $ligneClasse = "ligneImpaire";

            // (09) Extraction : Utilisation de fetch(PDO::FETCH_ASSOC) dans la boucle
            while ($donnees = $reponseRequete->fetch(PDO::FETCH_ASSOC)) {
                
                // Génération de l'en-tête du tableau (noms des colonnes) lors du premier passage
                if (!$enteteAffichee) {
                    echo "<tr>";
                    foreach ($donnees as $nomColonne => $valeur) {
                        // Utilisation des clés du tableau associatif pour les titres
                        echo "<th>" . htmlspecialchars($nomColonne) . "</th>";
                    }
                    echo "</tr>";
                    $enteteAffichee = true;
                }

                // Affichage d'une ligne de données
                echo "<tr class='$ligneClasse'>";
                foreach ($donnees as $valeur) {
                    // (09) Sécurité : Protection contre les injections XSS
                    // Gestion des valeurs NULL (affichage d'un espace insécable)
                    $affichage = ($valeur === null) ? "&nbsp;" : htmlspecialchars($valeur);
                    echo "<td>$affichage</td>";
                }
                echo "</tr>";

                // Alternance de la classe CSS pour les couleurs de lignes
                $ligneClasse = ($ligneClasse == "lignePaire") ? "ligneImpaire" : "lignePaire";
            }
            echo "</table>";
        }
    } else {
        echo "<p>La requête n'a retourné aucun résultat ou a échoué.</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erreur lors de l'exécution de la requête : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>