<?php
$dsn = 'mysql:host=localhost;dbname=monde2;charset=utf8';
$user = 'admin2';
$password = 'admin2';

try {
    $connexion = new PDO($dsn, $user, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Une erreur de connexion est survenue : ' . $e->getMessage();
    die();
}
?>