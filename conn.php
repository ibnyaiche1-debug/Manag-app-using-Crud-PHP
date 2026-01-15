<?php
$dsn  = "mysql:host=localhost;dbname=vpi_db";
$user = "root";
$pass = "";

try {
    $connection = new PDO($dsn, $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion");
}
?>
