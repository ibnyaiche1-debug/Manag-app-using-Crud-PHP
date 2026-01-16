<?php
require_once "conn.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id_etudiant"])) {
    $id = $_GET["id_etudiant"];

    $sql = "DELETE FROM etudiants WHERE id_etudiant = :id";
    $stmt = $connection->prepare($sql);

    if ($stmt->execute([":id" => $id])) {
        header("Location: accueil.php?del=1");
        exit;
    } else {
        echo "Erreur de suppression";
    }
} else {
    echo "ID non trouvé";
}
?>
