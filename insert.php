<?php
require_once "conn.php"; 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


if (
    !empty($_POST['cin_etudiant']) &&
    !empty($_POST['nom_etudiant']) &&
    !empty($_POST['prenom_etudiant']) &&
    !empty($_POST['filiere'])
) {
    $cin     = $_POST['cin_etudiant'];
    $nom     = $_POST['nom_etudiant'];
    $prenom  = $_POST['prenom_etudiant'];
    $filiere = $_POST['filiere'];

    $sql = "INSERT INTO etudiants (cin_etudiant, nom_etudiant, prenom_etudiant, filiere)
            VALUES (:cin, :nom, :prenom, :filiere)";

    $stmt = $connection->prepare($sql);

    if ($stmt->execute([
        ":cin" => $cin,
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":filiere" => $filiere
    ])) {
        header("Location: accueil.php?success=1");
        exit;
    } else {
        echo "Erreur lors de l'insertion";
    }
} else {
    header("Location: accueil.php?error=1");
    exit;
}
?>
