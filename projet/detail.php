<?php
    session_start();
    require_once 'includes/connexion.php';

    // Récupération de l'ID dans l'URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id === 0) 
    {
        header('Location: liste.php');
        exit;
    }

    // Récupération de la recette
    $stmt = $pdo->prepare
    ('
        SELECT r.*, c.nom AS categorie
        FROM Recette r
        LEFT JOIN Categorie c ON r.c_id = c.c_id
        WHERE r.r_id = ?
    ');
    $stmt->execute([$id]);
    $recette = $stmt->fetch();

    if (!$recette) 
    {
        header('Location: liste.php');
        exit;
    }

    // Récupération des étapes
    $stmt = $pdo->prepare('SELECT * FROM Etape WHERE r_id = ? ORDER BY nb_ordre');
    $stmt->execute([$id]);
    $etapes = $stmt->fetchAll();

    // Récupération des ingrédients
    $stmt = $pdo->prepare('
        SELECT i.nom, ri.quantite, ri.unite
        FROM Recette_Ingredient ri
        JOIN Ingredient i ON ri.i_id = i.i_id
        WHERE ri.r_id = ?
    ');
    $stmt->execute([$id]);
    $ingredients = $stmt->fetchAll();

    // Traitement du formulaire d'avis (le cas échéant)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])) 
    {
        if (!isset($_SESSION['u_id'])) 
        {
            header('Location: auth.php');
            exit;
        }
        $note = (int)$_POST['note'];
        $commentaire = trim($_POST['commentaire']);
        $stmt = $pdo->prepare('INSERT INTO Avis (u_id, r_id, note, commentaire, datepost) VALUES (?, ?, ?, ?, NOW())');
        $stmt->execute([$_SESSION['u_id'], $id, $note, $commentaire]);
        header('Location: detail.php?id=' . $id);
        exit;
    }

    // Récupération des avis de cette recette
    $stmt = $pdo->prepare
    ('
        SELECT a.*, p.pseudo
        FROM Avis a
        LEFT JOIN Profil p ON a.u_id = p.u_id
        WHERE a.r_id = ?
        ORDER BY a.datepost DESC
    ');
    $stmt->execute([$id]);
    $avis = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($recette['titre']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
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
        <h3>Avis (<?= count($avis) ?>)</h3>
        <?php if (isset($_SESSION['u_id'])) : ?>
            <form method="POST" action="detail.php?id=<?= $id ?>" class="mb-4">
                <div class="mb-2">
                    <label>Note :</label>
                    <select name="note" class="form-control" required>
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Très bien</option>
                        <option value="3">3 - Bien</option>
                        <option value="2">2 - Moyen</option>
                        <option value="1">1 - Décevant</option>
                    </select>
                </div>
                <div class="mb-2">
                    <textarea name="commentaire" class="form-control" placeholder="Votre commentaire" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Publier mon avis</button>
            </form>
        <?php else : ?>
            <p><a href="auth.php">Connectez-vous</a> pour laisser un avis.</p>
        <?php endif; ?>

        <?php foreach ($avis as $a) : ?>
            <div class="border-bottom mb-2 pb-2">
                <strong><?= htmlspecialchars($a['pseudo'] ?? 'Anonyme') ?></strong> — ⭐ <?= $a['note'] ?>/5
                <p><?= htmlspecialchars($a['commentaire']) ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</body>
</html>
