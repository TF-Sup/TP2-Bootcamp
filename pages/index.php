<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des contacts</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Liste des contacts</h1>
    <a href="add_contact.php" class="add-contact">Ajouter un nouveau contact</a>
    
    <?php
    require '../includes/db.php';
    $pdo = connectDB();
    $stmt = $pdo->query("SELECT * FROM contacts");
    $contacts = $stmt->fetchAll();
    ?>

    <table>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($contacts as $contact) : ?>
        <tr>
            <td><?= htmlspecialchars($contact['nom']) ?></td>
            <td><?= htmlspecialchars($contact['email']) ?></td>
            <td><?= htmlspecialchars($contact['telephone']) ?></td>
            <td>
                <a href="edit_contact.php?id=<?= $contact['id'] ?>">Modifier</a>
                <a href="delete.php?id=<?= $contact['id'] ?>" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>