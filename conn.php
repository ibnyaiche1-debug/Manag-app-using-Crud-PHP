<?php
$dsn  = "mysql:host=localhost;dbname=vpi_db;charset=utf8mb4";
$user = "root";
$pass = "";

try {
    $connection = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion");
}
