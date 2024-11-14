<?php
require '../includes/db.php';     // Inclut la connexion à la base de données
require '../includes/logique.php'; // Inclut les fonctions CRUD

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteContact($id); // Appel de la fonction pour supprimer le contact
}

header('Location: index.php');
exit();
?>