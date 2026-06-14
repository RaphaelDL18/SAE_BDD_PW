-- Utilisateur de test
INSERT INTO Utilisateur (email, mdp) VALUES ('delacroixlanglaisraphael@gmail.com', 'test');

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