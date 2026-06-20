<?php
session_start();
require_once 'includes/connexion.php';
$stmt = $pdo->query('SELECT r_id, titre, diff, nb_prsn FROM Recette');
$recettes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des recettes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
<div class="container mt-4">
    <h1>Nos recettes</h1>
    <div class="row">
        <?php foreach ($recettes as $recette) : ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($recette['titre']) ?></h5>
                        <p class="card-text">Difficulté : <?= $recette['diff'] ?>/5</p>
                        <p class="card-text">Personnes : <?= $recette['nb_prsn'] ?></p>
                        <a href="detail.php?id=<?= $recette['r_id'] ?>" class="btn btn-primary">Voir la recette</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>