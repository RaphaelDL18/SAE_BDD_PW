-- Utilisateur de test
INSERT INTO Utilisateur (email, mdp) VALUES ('delacroixlanglaisraphael@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

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