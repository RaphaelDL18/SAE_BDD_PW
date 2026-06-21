<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">🍳 Lahmakoon - Recettes</a>
        <div class="ms-auto">
            <?php if (isset($_SESSION['u_id'])) : ?>
                <span class="text-white me-3">Connecté : <?= htmlspecialchars($_SESSION['email']) ?></span>
                <a href="ajouter.php" class="btn btn-success btn-sm me-2">+ Ajouter une recette</a>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Déconnexion</a>
            <?php else : ?>
                <a href="auth.php" class="btn btn-outline-light btn-sm">Connexion / Inscription</a>
            <?php endif; ?>
        </div>
    </div>
</nav>