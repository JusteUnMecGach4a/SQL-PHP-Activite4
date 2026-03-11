<!DOCTYPE html>
  <html>
    <head>
        <meta charset="UTF-8"><link rel="stylesheet" type="text/css" href="stylePage.css">
<?php
    $numero=$_GET['numero'];
        echo "<title>Requête question $numero </title></head><body>";
    
// on inclue le fichier connexionBaseLocale.php à regarder 
include("connexionBaseLocale.php");

if (!$connexion) // test sur la connexion à la base
    {echo "probleme connexion";}
else 
    { // connexion réalisée
    //test du paramétre reçu
    if (is_numeric($numero))
        echo "<h1>Requête question $numero </h1>";
    else 
        echo "<h1>Le paramétre n'est pas un nombre. </h1>";

    switch ($numero) { //Gestion du paramétre relatif à la question
        case "1": //question 1
            $requete="SELECT Name FROM `Country` WHERE Continent='South America' ";
            
            echo '<p> Il s\'agit pour cette question de donner tous les pays d\'Amérique du sud. Il faut donc effectuer une projection sur la colonne des noms de pays en ne sélectionnant que le continent d\'Amérique du sud.</p>';
            echo '<div id="cadre"><p> La formulation de la requête SQL est :<br> SELECT Name FROM `Country` WHERE Continent="South America"</p></div>';
            break;
        case "2": //question 4
          $requete="SELECT City.Name , City.Population FROM `City` , `Country` WHERE Continent='Europe' AND Code = CountryCode AND City.Population>100000";
          echo '<p> Il s\'agit pour cette question de donner toutes les villes d\'Europe de plus de 100000 habitants. Il faut donc effectuer une jointure 
                entre les 2 tables (villes et pays) en sélectionnant le continent européen, les villes de plus de 100000 habitants et la correspondance des 2 tables au niveau des codes pays.</p>';
            echo '<div id="cadre"><p> La formulation de la requête SQL est :<br> SELECT City.Name , City.Population FROM `City` , `Country` WHERE Continent="Europe" AND Code = CountryCode AND City.Population>100000</p></div>';
            break;
        
    }
    // On inclue le fichier affichageTableauResultats.php à regarder
    include("affichageTableauResultats.php"); 

    
  }

mysqli_close($connexion);
echo "</body></html>";
?>

