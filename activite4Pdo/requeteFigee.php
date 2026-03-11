<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylePage.css">
<?php
    // Récupération du paramètre numéro passé dans l'URL
    $numero = isset($_GET['numero']) ? $_GET['numero'] : null;
    echo "<title>Requête question $numero </title></head><body>";
    
    // Inclusion de la connexion en PDO
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

        // Initialisation des variables pour éviter les erreurs si le numéro n'existe pas
        $requete = "";
        $intitule = "";
        $explication = "";

        // Gestion des différentes questions via le switch
        switch ($numero) {
            case "1":
                $requete = "SELECT Name FROM `Country` WHERE Continent='South America'";
                $intitule = "Pays d'Amérique du Sud.";
                $explication = "Cette requête filtre la table 'Country' pour extraire uniquement les noms des pays situés sur le continent 'South America'.";
                break;
                
            case "2":
                $requete = "SELECT City.Name, City.Population FROM `City`, `Country` WHERE Continent='Europe' AND Code = CountryCode AND City.Population > 100000";
                $intitule = "Villes d'Europe de plus de 100 000 habitants.";
                $explication = "On effectue ici une jointure entre les tables 'City' et 'Country' pour filtrer les villes par continent et par un seuil de population.";
                break;

            case "3":
                $requete = "SELECT DISTINCT Language FROM CountryLanguage JOIN Country ON Country.Code = CountryLanguage.CountryCode WHERE Region = 'Eastern Europe' AND IsOfficial = 'T'";
                $intitule = "Quelles sont les langues officielles des pays d'Europe de l'est ?";
                $explication = "L'utilisation de DISTINCT permet d'éliminer les doublons de langues. La jointure cible spécifiquement la région 'Eastern Europe' et le statut officiel ('T').";
                break;

            case "4":
                $requete = "SELECT DISTINCT Country.Name FROM Country JOIN City ON Country.Code = City.CountryCode";
                $intitule = "Quels sont les pays de plus de 100 millions d'habitants ?";
                $explication = "Cette requête liste les noms uniques de pays possédant au moins une ville enregistrée dans la base de données.";
                break;

            case "5":
                $requete = "SELECT Name FROM Country WHERE Continent = 'Asia' ORDER BY LifeExpectancy ASC LIMIT 1";
                $intitule = "Quel est le pays asiatique avec la plus faible espérance de vie ?";
                $explication = "Le tri 'ORDER BY LifeExpectancy ASC' place la valeur la plus basse en premier, et 'LIMIT 1' permet de ne récupérer que ce résultat précis.";
                break;

            case "6":
                $requete = "SELECT City.Name FROM City JOIN Country ON City.CountryCode = Country.Code JOIN CountryLanguage ON Country.Code = CountryLanguage.CountryCode WHERE Continent = 'Africa' AND City.Population < 100000 AND Language = 'French' AND IsOfficial = 'T'";
                $intitule = "Donner toutes les villes de moins de 100 000 habitants, d'Afrique, ayant le français pour langue officielle.";
                $explication = "Il s'agit d'une triple jointure complexe filtrant sur trois critères : la géographie (Afrique), la démographie (moins de 100 000) et la langue officielle (Français).";
                break;

            case "7":
                $requete = "SELECT AVG(City.Population) AS Population_Moyenne FROM City JOIN Country ON City.CountryCode = Country.Code WHERE Continent = 'Asia'";
                $intitule = "Quelle est la population moyenne des villes d'Asie ?";
                $explication = "La fonction d'agrégation 'AVG' calcule automatiquement la moyenne de la population pour toutes les villes répondant au critère du continent asiatique.";
                break;
        }

        // Affichage de la requête SQL et du résultat
        if ($requete != "") {
            echo "<p>$intitule</p>";
            echo '<div id="cadre"><p> La formulation de la requête SQL est :<br> <code>' . htmlspecialchars($requete) . '</code></p></div>';
            
            // Inclusion du fichier de traitement et d'affichage (PDO)
            include("affichageTableauResultats.php");

            // Affichage de l'explication demandée sous le tableau
            echo "<div style='margin: 20px auto; padding: 15px; border: 1px dashed #fff; width: 80%; background: rgba(255,255,255,0.1);'>";
            echo "<h3 style='color: #000;'>Explication de la requête :</h3>";
            echo "<p style='font-size: 1.1em; font-style: italic;'>" . htmlspecialchars($explication) . "</p>";
            echo "</div>";
        }

        // Déconnexion de la base
        $reponseRequete = null;
        $connexion = null;
    }

    echo "</body></html>";
?>
