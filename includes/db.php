<?php
/**
 * Fonction de connexion à la base de données
 * Retourne un objet PDO connecté à la base de données.
 */
function connectDB() {
    $host = 'localhost';
    $dbname = 'contacts_db';
    $username = 'root';
    $password = '';

    try {
        // Connexion à MySQL et création de la base de données si nécessaire
        $connectDB = new PDO("mysql:host=$host", $username, $password);
        $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création de la base de données si elle n'existe pas
        $connectDB->query("CREATE DATABASE IF NOT EXISTS $dbname");

        // Sélection de la base de données
        $connectDB->exec("USE $dbname");

        // Création de la table `contacts` si elle n'existe pas
        $tableQuery = "
            CREATE TABLE IF NOT EXISTS contacts (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                telephone VARCHAR(15) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";
        $connectDB->exec($tableQuery);

        // Vérification si la table est vide pour insérer un contact initial pour les tests
        $stmt = $connectDB->query("SELECT COUNT(*) FROM contacts");
        $count = $stmt->fetchColumn();
        if ($count == 0) {
            $insertQuery = "
                INSERT INTO contacts (nom, email, telephone) 
                VALUES ('TEST', 'Test@gmail.com', '0642658787');
            ";
            $connectDB->exec($insertQuery);
        }

        return $connectDB;

    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

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

// Fonction pour récupérer un contact par ID
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
