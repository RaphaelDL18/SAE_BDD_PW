<?php
    session_start();
    require_once 'includes/connexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $action = $_POST['action'];
        $email = trim($_POST['email']);
        $mdp = $_POST['mdp'];

        if ($action === 'inscription') 
        {
            // Vérification de l'existence de l'email
            $stmt = $pdo->prepare('SELECT u_id FROM Utilisateur WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) 
            {
                $erreur = "Cet email est déjà utilisé.";
            } 
            else 
            {
                // Hashage du mot de passe
                $hash = password_hash($mdp, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare('INSERT INTO Utilisateur (email, mdp) VALUES (?, ?)');
                $stmt->execute([$email, $hash]);
                $succes = "Compte créé ! Vous pouvez vous connecter.";
            }
        }

        if ($action === 'connexion')
        {
            $stmt = $pdo->prepare('SELECT * FROM Utilisateur WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user && password_verify($mdp, $user['mdp'])) 
            {
                $_SESSION['u_id'] = $user['u_id'];
                $_SESSION['email'] = $user['email'];
                header('Location: liste.php');
                exit;
            }
            else 
            {
                $erreur = "Email ou mot de passe incorrect.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion / Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
    <div class="container mt-4">
        <?php if (!empty($erreur)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>
        <?php if (!empty($succes)) : ?>
        <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
        <?php endif; ?>

        <!-- CONNEXION -->
        <h2>Se connecter</h2>
        <form method="POST" action="auth.php">
            <input type="hidden" name="action" value="connexion">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>

        <hr>

        <!-- INSCRIPTION -->
        <h2>Créer un compte</h2>
        <form method="POST" action="auth.php">
            <input type="hidden" name="action" value="inscription">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-success">Créer un compte</button>
        </form>

    </div>
</body>
</html>