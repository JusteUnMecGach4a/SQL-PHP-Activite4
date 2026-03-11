<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylePage.css">
<?php
    // Récupération du paramètre numéro passé dans l'URL
    $numero = isset($_GET['numero']) ? $_GET['numero'] : null;
    echo "<title>Requête question $numero </title></head><body>";
    
    // (08) Inclusion de la connexion (désormais en PDO)
    include("connexionBaseLocale.php");

    // Vérification de la validité de la connexion
    if (!$connexion) {
        echo "<p style='color:red;'>Problème de connexion à la base de données.</p>";
    } else {
        // Validation du paramètre reçu
        if (is_numeric($numero)) {
            echo "<h1>Requête question $numero </h1>";
        } else {
            echo "<h1>Le paramètre n'est pas un nombre. </h1>";
        }

        // (11-15) Gestion des différentes questions via le switch
        switch ($numero) {
            case "1":
                $requete = "SELECT Name FROM `Country` WHERE Continent='South America'";
                echo '<p>Pays d\'Amérique du Sud.</p>';
                break;
                
            case "2":
                $requete = "SELECT City.Name, City.Population FROM `City`, `Country` WHERE Continent='Europe' AND Code = CountryCode AND City.Population > 100000";
                echo '<p>Villes d\'Europe de plus de 100 000 habitants.</p>';
                break;
            case "3":
                $requete = "SELECT DISTINCT Language FROM CountryLanguage JOIN Country ON Country.Code = CountryLanguage.CountryCode WHERE Region = 'Eastern Europe' AND IsOfficial = 'T'";
                echo '<p>Quelles sont les langues officielles des pays d\'Europe de l\'est ?</p>';
                break;
            case "4":
                $requete = "SELECT DISTINCT Country.Name FROM Country JOIN City ON Country.Code = City.CountryCode";
                echo '<p>Quels sont les pays de plus de 100 millions d\'habitants ?</p>';
                break;
            case "5":
                $requete = "SELECT Name FROM Country WHERE Continent = 'Asia' ORDER BY LifeExpectancy ASC LIMIT 1";
                echo '<p>Quel est le pays asiatique avec la plus faible espérance de vie ?</p>';
                break;
            case "6":
                $requete = "SELECT City.Name FROM City JOIN Country ON City.CountryCode = Country.Code JOIN CountryLanguage ON Country.Code = CountryLanguage.CountryCode WHERE Continent = 'Africa' AND City.Population < 100000 AND Language = 'French' AND IsOfficial = 'T'";
                echo '<p>Donner toutes les villes de moins de 100 000 habitants, d\'Afrique, ayant le français pour langueofficielle.</p>';
                break;
            case "7":
                $requete = "SELECT AVG(City.Population) AS Population_Moyenne FROM City JOIN Country ON City.CountryCode = Country.Code WHERE Continent = 'Asia'";
                echo '<p>Quelle est la population moyenne des villes d\'Asie ?</p>';
                break;
        }
        // Affichage de la requête SQL pour le compte rendu
        if (isset($requete)) {
            echo '<div id="cadre"><p> La formulation de la requête SQL est :<br> <code>' . htmlspecialchars($requete) . '</code></p></div>';
            
            // Inclusion du fichier de traitement et d'affichage (mis à jour en PDO)
            include("affichageTableauResultats.php");
        }

        // (10) Réaliser la déconnexion de la base
        // On libère d'abord l'objet de résultat (défini dans affichageTableauResultats.php)
        $reponseRequete = null; 
        // Puis on ferme la connexion en détruisant l'objet PDO
        $connexion = null; 
    }

    echo "</body></html>";
?>