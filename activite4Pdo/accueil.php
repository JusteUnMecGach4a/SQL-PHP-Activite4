<!DOCTYPE html>
  <html>

<!-- Pas de commentaires particuliers pour ce fichier hormis la mise en place d'un choix de 2 questions-->
    <head>
        <title>Accueil </title>
        <meta charset="UTF-8">
          <link rel="stylesheet" type="text/css" href="stylePage.css">
      </head>
<?php
//Utilisation de 2 liens sur le fichier requeteFigee.php avec un paramètre
echo '
<body>
  <h1>Cette page vous permet de sélectionner une question parmi les questions proposées. </h1>
      <ul>
        <li><a href="requeteFigee.php?numero=1">Question 1</a></li>
        <li><a href="requeteFigee.php?numero=2">Question 2</a></li>
        <li><a href="requeteFigee.php?numero=3">Question 3</a></li>
        <li><a href="requeteFigee.php?numero=4">Question 4</a></li>
        <li><a href="requeteFigee.php?numero=5">Question 5</a></li>
        <li><a href="requeteFigee.php?numero=6">Question 6</a></li>
        <li><a href="requeteFigee.php?numero=7">Question 7</a></li>
      </ul>  
</body>
</html>
';
?>
