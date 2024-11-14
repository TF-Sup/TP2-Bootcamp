<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le contact</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Modifier le contact</h1>

    <?php
    require '../includes/db.php';     // Inclut la connexion à la base de données
    require '../includes/logique.php'; // Inclut les fonctions CRUD
    $errorMessage = '';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $contact = getContact($id);
        if (!$contact) {
            echo "<p>Contact non trouvé.</p>";
            exit();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $telephone = trim($_POST['telephone']);

        // Validation des données
        if (empty($nom) || strlen($nom) > 100) {
            $errorMessage = "Le nom doit contenir au maximum 100 caractères.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "L'email n'est pas valide.";
        } elseif (!preg_match('/^[0-9]{10,15}$/', $telephone)) {
            $errorMessage = "Le numéro de téléphone doit contenir entre 10 et 15 chiffres.";
        } else {
            $pdo = connectDB();
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contacts WHERE email = :email AND id != :id");
            $stmt->execute(['email' => $email, 'id' => $id]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $errorMessage = "Cet email est déjà utilisé.";
            } else {
                updateContact($id, $nom, $email, $telephone);
                header('Location: index.php');
                exit();
            }
        }
    }
    ?>

    <?php if (!empty($errorMessage)) : ?>
        <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>

    <form action="edit_contact.php?id=<?= $contact['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($contact['nom']) ?>" required>
        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required>
        <label>Téléphone :</label>
        <input type="text" name="telephone" value="<?= htmlspecialchars($contact['telephone']) ?>" required>
        <button type="submit">Modifier</button>
    </form>
</div>
</body>
</html>