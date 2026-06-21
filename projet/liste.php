<?php
    session_start();
    require_once 'includes/connexion.php';

    // Récupération des catégories pour le menu déroulant
    $categories = $pdo->query('SELECT * FROM Categorie')->fetchAll();

    // Construction de la requête dynamique
    $sql = 'SELECT r_id, titre, diff, nb_prsn FROM Recette WHERE 1=1';
    // Création du stock des paramètres de la requête créée ci-dessus
    $params = []; 
    
    // Vérification du champ de recherche
    if (!empty($_GET['recherche'])) 
    {
        $sql .= ' AND titre LIKE ?';
        $params[] = '%' . $_GET['recherche'] . '%';
    }

    // Vérification du filtre des catégories
    if (!empty($_GET['categorie']))
    {
        $sql .= ' AND c_id = ?';
        $params[] = $_GET['categorie'];
    }

    // Exécution de la commande
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $recettes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Lahmakoon - Recettes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
<div class="container mt-4">
    <form method="GET" action="liste.php" class="row mb-4">
        <div class="col-md-6">
            <input type="text" name="recherche" class="form-control" placeholder="Rechercher une recette..." value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <select name="categorie" class="form-control">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $cat) : ?>
                    <option value="<?= $cat['c_id'] ?>" <?= (isset($_GET['categorie']) && $_GET['categorie'] == $cat['c_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </div>
    </form>
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