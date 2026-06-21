-- Utilisateur de test
INSERT INTO Utilisateur (email, mdp) VALUES ('test@test.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
-- Profil associé
INSERT INTO Profil (u_id, nom, prenom, pseudo) VALUES (1, 'Delacroix-Langlais', 'Raphaël', 'Xx_Etchebest_xX');

-- Catégorie
INSERT INTO Categorie (nom) VALUES ('Pâtes');

-- Recette 
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 1, 'Pâtes Bolognaise', 'Un grand classique de la cuisine italienne.', 15, 45, 4, 2);

-- Étapes 
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (1, 1, 'Faire revenir l\'oignon et l\'ail dans l\'huile d\'olive.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (1, 2, 'Ajouter le boeuf haché et faire dorer.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (1, 3, 'Incorporer le concentré de tomate et laisser mijoter 30 minutes.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (1, 4, 'Cuire les pâtes al dente et servir avec la sauce.');

-- Ingrédients liés
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (1, 2, 1, 'pièce');    -- Oignon
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (1, 3, 2, 'gousse');   -- Ail
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (1, 17, 400, 'g');     -- Boeuf haché
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (1, 54, 2, 'càs');     -- Concentré de tomate
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (1, 33, 400, 'g');     -- Pâtes
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (1, 51, 2, 'càs');     -- Huile d'olive

-- Nouvelles catégories
INSERT INTO Categorie (nom) VALUES ('Dessert');
INSERT INTO Categorie (nom) VALUES ('Salade');
INSERT INTO Categorie (nom) VALUES ('Soupe');

-- Recette 2 : Salade César (c_id = 3)
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 3, 'Salade César', 'Une salade fraîche et croquante.', 15, 0, 2, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (2, 1, 'Laver et couper la salade.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (2, 2, 'Ajouter le parmesan et assaisonner.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (2, 25, 1, 'pièce');   -- Parmesan ou autre selon ton i_id réel
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (2, 51, 1, 'càs');      -- Huile d'olive

-- Recette 3 : Tarte aux pommes (c_id = 2, Dessert)
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 2, 'Tarte aux pommes', 'Un dessert simple et gourmand.', 20, 35, 6, 2);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (3, 1, 'Étaler la pâte dans un moule.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (3, 2, 'Disposer les pommes coupées en fines tranches.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (3, 3, 'Cuire 35 minutes à 180°C.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (3, 64, 4, 'pièce');   -- Pomme
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (3, 28, 1, 'pièce');   -- Beurre

-- Recette 4 : Soupe de légumes (c_id = 4, Soupe)
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 4, 'Soupe de légumes', 'Une soupe réconfortante et healthy.', 15, 30, 4, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (4, 1, 'Éplucher et couper les légumes.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (4, 2, 'Faire cuire 30 minutes dans le bouillon.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (4, 3, 'Mixer et assaisonner.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (4, 4, 2, 'pièce');    -- Carotte
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (4, 9, 2, 'pièce');    -- Pomme de terre
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (4, 56, 1, 'cube');    -- Bouillon de poulet

-- Recette 5 : Riz aux crevettes (c_id = 1, Pâtes/Plat)
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 1, 'Riz aux crevettes', 'Un plat rapide et savoureux.', 10, 20, 3, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (5, 1, 'Cuire le riz selon les instructions.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (5, 2, 'Faire revenir les crevettes avec ail et persil.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (5, 3, 'Mélanger riz et crevettes, servir chaud.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (5, 34, 300, 'g');     -- Riz
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (5, 21, 300, 'g');     -- Crevettes
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (5, 3, 2, 'gousse');   -- Ail

-- Recette 6 : Poulet au curry
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 1, 'Poulet au curry', 'Un plat parfumé et réconfortant.', 15, 25, 4, 2);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (6, 1, 'Couper le poulet en morceaux et le faire dorer.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (6, 2, 'Ajouter l\'oignon émincé et le curcuma, laisser revenir.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (6, 3, 'Verser le lait de coco et laisser mijoter 20 minutes.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (6, 16, 500, 'g');     -- Poulet
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (6, 2, 1, 'pièce');     -- Oignon
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (6, 39, 1, 'càc');      -- Curcuma

-- Recette 7 : Omelette aux champignons
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 1, 'Omelette aux champignons', 'Simple, rapide, et délicieuse.', 5, 10, 2, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (7, 1, 'Faire revenir les champignons émincés dans le beurre.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (7, 2, 'Battre les œufs et les verser dans la poêle.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (7, 3, 'Cuire à feu moyen et plier en deux avant de servir.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (7, 27, 4, 'pièce');    -- Oeuf
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (7, 12, 150, 'g');      -- Champignon
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (7, 24, 1, 'càs');      -- Beurre

-- Recette 8 : Houmous de pois chiches
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 3, 'Houmous de pois chiches', 'Une recette orientale facile à préparer.', 10, 0, 4, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (8, 1, 'Mixer les pois chiches avec l\'ail et le citron.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (8, 2, 'Ajouter l\'huile d\'olive petit à petit en mixant.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (8, 3, 'Assaisonner et servir frais.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (8, 37, 400, 'g');      -- Pois chiches
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (8, 3, 1, 'gousse');    -- Ail
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (8, 60, 1, 'pièce');    -- Citron
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (8, 51, 3, 'càs');      -- Huile d'olive

-- Recette 9 : Gratin dauphinois
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 1, 'Gratin dauphinois', 'Un classique réconfortant de la cuisine française.', 20, 45, 6, 2);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (9, 1, 'Éplucher et couper les pommes de terre en fines rondelles.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (9, 2, 'Disposer en couches dans un plat avec la crème.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (9, 3, 'Cuire 45 minutes à 180°C jusqu\'à coloration.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (9, 9, 1, 'kg');        -- Pomme de terre
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (9, 23, 30, 'cl');      -- Crème fraîche
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (9, 26, 100, 'g');      -- Fromage râpé

-- Recette 10 : Cookies au chocolat
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 2, 'Cookies au chocolat', 'Des cookies moelleux et gourmands.', 15, 12, 8, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (10, 1, 'Mélanger le beurre, le sucre et l\'œuf.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (10, 2, 'Ajouter la farine, la levure et le chocolat en morceaux.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (10, 3, 'Former des boules et cuire 12 minutes à 180°C.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (10, 31, 200, 'g');     -- Farine
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (10, 24, 100, 'g');     -- Beurre
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (10, 56, 150, 'g');     -- Chocolat noir
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (10, 35, 1, 'càc');     -- Levure chimique

-- Recette 11 : Smoothie banane-fraise
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 2, 'Smoothie banane-fraise', 'Frais, sucré, et rapide à préparer.', 5, 0, 2, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (11, 1, 'Couper la banane et les fraises.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (11, 2, 'Mixer le tout avec le lait jusqu\'à consistance lisse.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (11, 67, 1, 'pièce');   -- Banane
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (11, 68, 150, 'g');     -- Fraise
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (11, 22, 20, 'cl');     -- Lait

-- Recette 12 : Lentilles à l'indienne
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 4, 'Lentilles à l\'indienne', 'Un plat épicé et nourrissant.', 10, 25, 4, 2);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (12, 1, 'Faire revenir l\'oignon et l\'ail avec le cumin.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (12, 2, 'Ajouter les lentilles et couvrir d\'eau.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (12, 3, 'Laisser mijoter 25 minutes jusqu\'à cuisson complète.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (12, 36, 250, 'g');     -- Lentilles
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (12, 2, 1, 'pièce');    -- Oignon
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (12, 38, 1, 'càc');     -- Cumin

-- Recette 13 : Salade de fruits
INSERT INTO Recette (u_id, c_id, titre, descript, tps_prep, tps_cuis, nb_prsn, diff)
VALUES (1, 2, 'Salade de fruits', 'Légère et parfaite en dessert.', 15, 0, 4, 1);

INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (13, 1, 'Couper tous les fruits en morceaux.');
INSERT INTO Etape (r_id, nb_ordre, descript) VALUES (13, 2, 'Mélanger avec un peu de jus de citron et de miel.');

INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (13, 66, 2, 'pièce');   -- Orange
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (13, 67, 2, 'pièce');   -- Banane
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (13, 75, 1, 'pièce');   -- Mangue
INSERT INTO Recette_Ingredient (r_id, i_id, quantite, unite) VALUES (13, 62, 1, 'càs');     -- Miel