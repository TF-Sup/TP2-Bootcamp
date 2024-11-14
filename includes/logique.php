<?php

// Fonction pour ajouter un contact
function addContact($nom, $email, $telephone) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, telephone) VALUES (:nom, :email, :telephone)");
    $stmt->execute([
        'nom' => $nom,
        'email' => $email,
        'telephone' => $telephone
    ]);
}

// Fonction pour récupérer un contact par son ID
function getContact($id) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

// Fonction pour mettre à jour un contact
function updateContact($id, $nom, $email, $telephone) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("UPDATE contacts SET nom = :nom, email = :email, telephone = :telephone WHERE id = :id");
    $stmt->execute([
        'id' => $id,
        'nom' => $nom,
        'email' => $email,
        'telephone' => $telephone
    ]);
}

// Fonction pour supprimer un contact
function deleteContact($id) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
?>