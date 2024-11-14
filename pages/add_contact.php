<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un contact</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Ajouter un nouveau contact</h1>

    <?php
    require '../includes/db.php';
    $errorMessage = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contacts WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $errorMessage = "Cet email est déjà utilisé.";
            } else {
                addContact($nom, $email, $telephone);
                header('Location: index.php');
                exit();
            }
        }
    }
    ?>

    <?php if (!empty($errorMessage)) : ?>
        <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>

    <form action="add_contact.php" method="post">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        <label>Email :</label>
        <input type="email" name="email" required>
        <label>Téléphone :</label>
        <input type="text" name="telephone" required>
        <button type="submit">Ajouter</button>
    </form>
</div>
</body>
</html>