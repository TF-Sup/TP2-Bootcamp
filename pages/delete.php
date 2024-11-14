<?php
require '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteContact($id); // Appel de la fonction pour supprimer le contact
}

header('Location: index.php');
exit();
?>