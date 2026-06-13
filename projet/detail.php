<?php
session_start();
require_once 'includes/connexion.php';

// Récupérer l'ID dans l'URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    header('Location: liste.php');
    exit;
}

// Récupérer la recette
$stmt = $pdo->prepare('
    SELECT r.*, c.nom AS categorie
    FROM Recette r
    LEFT JOIN Categorie c ON r.c_id = c.c_id
    WHERE r.r_id = ?
');
$stmt->execute([$id]);
$recette = $stmt->fetch();

if (!$recette) {
    header('Location: liste.php');
    exit;
}

// Récupérer les étapes
$stmt = $pdo->prepare('SELECT * FROM Etape WHERE r_id = ? ORDER BY nb_ordre');
$stmt->execute([$id]);
$etapes = $stmt->fetchAll();

// Récupérer les ingrédients
$stmt = $pdo->prepare('
    SELECT i.nom, ri.quantite, ri.unite
    FROM Recette_Ingredient ri
    JOIN Ingredient i ON ri.i_id = i.i_id
    WHERE ri.r_id = ?
');
$stmt->execute([$id]);
$ingredients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($recette['titre']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">

    <a href="liste.php" class="btn btn-secondary mb-3">← Retour à la liste</a>

    <h1><?= htmlspecialchars($recette['titre']) ?></h1>
    <p class="text-muted">Catégorie : <?= htmlspecialchars($recette['categorie'] ?? 'Non définie') ?></p>

    <ul class="list-inline">
        <li class="list-inline-item">⏱ Préparation : <?= $recette['tps_prep'] ?> min</li>
        <li class="list-inline-item">🔥 Cuisson : <?= $recette['tps_cuis'] ?> min</li>
        <li class="list-inline-item">👥 Personnes : <?= $recette['nb_prsn'] ?></li>
        <li class="list-inline-item">⭐ Difficulté : <?= $recette['diff'] ?>/5</li>
    </ul>

    <p><?= htmlspecialchars($recette['descript']) ?></p>

    <h3>Ingrédients</h3>
    <ul>
        <?php foreach ($ingredients as $ing) : ?>
            <li><?= htmlspecialchars($ing['nom']) ?> — <?= $ing['quantite'] ?> <?= htmlspecialchars($ing['unite']) ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Étapes</h3>
    <ol>
        <?php foreach ($etapes as $etape) : ?>
            <li><?= htmlspecialchars($etape['descript']) ?></li>
        <?php endforeach; ?>
    </ol>

</div>
</body>
</html>