<?php
    session_start();
    require_once 'includes/connexion.php';

    // Il faut être connecté pour ajouter une recette
    if (!isset($_SESSION['u_id'])) 
    {
        header('Location: auth.php');
        exit;
    }

    // Récupérer les catégories pour le menu déroulant
    $categories = $pdo->query('SELECT * FROM Categorie')->fetchAll();

    $erreur = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {

        // Récupération et nettoyage des champs principaux 
        $titre      = trim($_POST['titre'] ?? '');
        $descript   = trim($_POST['descript'] ?? '');
        $c_id       = !empty($_POST['c_id']) ? (int)$_POST['c_id'] : null;
        $tps_prep   = (int)($_POST['tps_prep'] ?? 0);
        $tps_cuis   = (int)($_POST['tps_cuis'] ?? 0);
        $nb_prsn    = (int)($_POST['nb_prsn'] ?? 0);
        $diff       = (int)($_POST['diff'] ?? 1);

        // Récupération des ingrédients (tableaux parallèles) 
        $ing_noms = $_POST['ing_nom'] ?? [];
        $ing_qtes = $_POST['ing_qte'] ?? [];
        $ing_unites = $_POST['ing_unite'] ?? [];

        // Récupération des étapes 
        $etapes = $_POST['etape'] ?? [];

        // Validation minimale 
        if ($titre === '') 
        {
            $erreur = "Le titre de la recette est obligatoire.";
        } 
        elseif ($diff < 1 || $diff > 5) 
        {
            $erreur = "La difficulté doit être comprise entre 1 et 5.";
        }

        // Vérification de l'existence d'au moins un ingrédient et une étape valide
        $ingredients_valides = [];
        foreach ($ing_noms as $i => $nom)
        {
            $nom = trim($nom);
            if ($nom !== '') 
            {
                $ingredients_valides[] = 
                [
                    'nom' => $nom,
                    'quantite' => (int)($ing_qtes[$i] ?? 1),
                    'unite' => trim($ing_unites[$i] ?? '') ?: 'pièce'
                ];
            }
        }

        $etapes_valides = [];
        foreach ($etapes as $e) 
        {
            $e = trim($e);
            if ($e !== '') 
            {
                $etapes_valides[] = $e;
            }
        }

        // Affichage des erreurs le cas échéant
        if ($erreur === '' && empty($ingredients_valides)) 
        {
            $erreur = "Ajoutez au moins un ingrédient.";
        }
        if ($erreur === '' && empty($etapes_valides)) 
        {
            $erreur = "Ajoutez au moins une étape.";
        }

        if ($erreur === '') 
        {
            try 
            {
                $pdo->beginTransaction();

                // Insertion de la recette
                $stmt = $pdo->prepare
                ('
                    INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ');
                $stmt->execute
                ([
                    $_SESSION['u_id'],
                    $c_id,
                    $titre,
                    $descript,
                    $tps_prep,
                    $tps_cuis,
                    $nb_prsn,
                    $diff
                ]);
                $r_id = $pdo->lastInsertId();

                // Insertion des étapes
                $stmtEtape = $pdo->prepare('INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (?, ?, ?)');
                $ordre = 1;
                foreach ($etapes_valides as $descriptEtape) 
                {
                    $stmtEtape->execute([$r_id, $ordre, $descriptEtape]);
                    $ordre++;
                }

                // Insertion des ingrédients (en créant l'ingrédient s'il n'existe pas encore)
                $stmtCherche = $pdo->prepare('SELECT i_id FROM Ingredient WHERE nom = ?');
                $stmtCreeIng = $pdo->prepare('INSERT INTO Ingredient (nom) VALUES (?)');
                $stmtLienIng = $pdo->prepare('INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (?, ?, ?, ?)');

                foreach ($ingredients_valides as $ing) 
                {
                    $stmtCherche->execute([$ing['nom']]);
                    $ligne = $stmtCherche->fetch();

                    if ($ligne) 
                    {
                        $i_id = $ligne['i_id'];
                    } 
                    else 
                    {
                        $stmtCreeIng->execute([$ing['nom']]);
                        $i_id = $pdo->lastInsertId();
                    }

                    $stmtLienIng->execute([$r_id, $i_id, $ing['quantite'], $ing['unite']]);
                }

                $pdo->commit();

                header('Location: detail.php?id=' . $r_id);
                exit;
            } 
            catch (PDOException $e) 
            {
                $pdo->rollBack();
                $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une recette</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
    <div class="container mt-4 mb-5">

        <h1>Ajouter une recette</h1>

        <?php if (!empty($erreur)) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <form method="POST" action="ajouter.php">

            <!-- Informations générales -->
            <h3 class="mt-4">Informations générales</h3>

            <div class="mb-3">
                <label class="form-label">Titre de la recette *</label>
                <input type="text" name="titre" class="form-control" required
                    value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="descript" class="form-control" rows="3"><?= htmlspecialchars($_POST['descript'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select name="c_id" class="form-control">
                    <option value="">-- Aucune --</option>
                    <?php foreach ($categories as $cat) : ?>
                        <option value="<?= $cat['c_id'] ?>"
                            <?= (isset($_POST['c_id']) && $_POST['c_id'] == $cat['c_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Temps de préparation (min)</label>
                    <input type="number" name="tps_prep" class="form-control" min="0"
                        value="<?= htmlspecialchars($_POST['tps_prep'] ?? 0) ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Temps de cuisson (min)</label>
                    <input type="number" name="tps_cuis" class="form-control" min="0"
                        value="<?= htmlspecialchars($_POST['tps_cuis'] ?? 0) ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Nombre de personnes</label>
                    <input type="number" name="nb_prsn" class="form-control" min="1"
                        value="<?= htmlspecialchars($_POST['nb_prsn'] ?? 4) ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Difficulté (1 à 5)</label>
                    <input type="number" name="diff" class="form-control" min="1" max="5"
                        value="<?= htmlspecialchars($_POST['diff'] ?? 1) ?>">
                </div>
            </div>

            <!-- Ingrédients -->
            <h3 class="mt-4">Ingrédients *</h3>
            <div id="ingredients-container">
                <!-- les lignes sont ajoutées ici en JS -->
            </div>
            <button type="button" id="btn-add-ingredient" class="btn btn-outline-secondary btn-sm mb-3">
                + Ajouter un ingrédient
            </button>

            <!-- Étapes -->
            <h3 class="mt-4">Étapes de préparation *</h3>
            <div id="etapes-container">
                <!-- les lignes sont ajoutées ici en JS -->
            </div>
            <button type="button" id="btn-add-etape" class="btn btn-outline-secondary btn-sm mb-3">
                + Ajouter une étape
            </button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Publier la recette</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

    <!-- Template pour une ligne d'ingrédient (caché, cloné en JS) -->
    <template id="template-ingredient">
        <div class="row mb-2 ingredient-row">
            <div class="col-md-6">
                <input type="text" name="ing_nom[]" class="form-control" placeholder="Nom de l'ingrédient (ex : Tomate)">
            </div>
            <div class="col-md-3">
                <input type="number" name="ing_qte[]" class="form-control" placeholder="Quantité" min="0" value="1">
            </div>
            <div class="col-md-2">
                <input type="text" name="ing_unite[]" class="form-control" placeholder="Unité (ex : g, pièce)">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger btn-sm btn-remove-row">✕</button>
            </div>
        </div>
    </template>

    <!-- Template pour une ligne d'étape (caché, cloné en JS) -->
    <template id="template-etape">
        <div class="row mb-2 etape-row">
            <div class="col-md-11">
                <textarea name="etape[]" class="form-control" rows="2" placeholder="Décrivez cette étape..."></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger btn-sm btn-remove-row">✕</button>
            </div>
        </div>
    </template>

    <script>
        function addRow(containerId, templateId) {
            const container = document.getElementById(containerId);
            const template = document.getElementById(templateId);
            const clone = template.content.cloneNode(true);

            // Bouton de suppression de la ligne
            clone.querySelector('.btn-remove-row').addEventListener('click', function () 
            {
                this.closest('.row').remove();
            });

            container.appendChild(clone);
        }

        document.getElementById('btn-add-ingredient').addEventListener('click', function () 
        {
            addRow('ingredients-container', 'template-ingredient');
        });

        document.getElementById('btn-add-etape').addEventListener('click', function () 
        {
            addRow('etapes-container', 'template-etape');
        });

        // Par défaut, il y a 3 lignes d'ingrédients et 2 lignes d'étapes
        addRow('ingredients-container', 'template-ingredient');
        addRow('ingredients-container', 'template-ingredient');
        addRow('ingredients-container', 'template-ingredient');
        addRow('etapes-container', 'template-etape');
        addRow('etapes-container', 'template-etape');
    </script>

</body>
</html>
