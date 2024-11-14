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
        // Connexion à MySQL sans spécifier de base de données pour créer une nouvelle base si nécessaire
        $connectDB = new PDO("mysql:host=$host", $username, $password);
        $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création de la base de données si elle n'existe pas
        $connectDB->query("CREATE DATABASE IF NOT EXISTS $dbname");

        // Sélection de la base de données
        $connectDB->exec("USE $dbname");

        // Création de la table `contacts` si elle n'existe pas déjà
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
        
        // Si aucun contact n'est présent, on insère un contact de test
        if ($count == 0) {
            $insertQuery = "
                INSERT INTO contacts (nom, email, telephone) 
                VALUES ('TEST', 'TEST@gmail.com', '06000000');
            ";
            $connectDB->exec($insertQuery);
        }

        // Retourne l'objet PDO connecté pour des opérations supplémentaires
        return $connectDB;

    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>
