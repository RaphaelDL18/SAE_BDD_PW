SAE BDD PW - Gestion de Recettes de Cuisine

Description

Application web de gestion de recettes de cuisine permettant aux utilisateurs de consulter des recettes, de les rechercher et de les filtrer par catégorie, de poster des avis, et d'ajouter leurs propres recettes une fois connectés. Les données de démonstration incluent une treizaine de recettes réparties sur plusieurs catégories.

Stack technique


PHP 8.x (PDO)
MySQL / MariaDB
JavaScript
Bootstrap 5.3
Git


Structure de la base de données

La base de données repose sur 8 tables, avec les trois types de relations suivants :


Relation 1-1 : Utilisateur / Profil — chaque utilisateur possède un seul profil, et inversement.
Relations 1-N : un Utilisateur peut poster plusieurs Avis ; une Recette est composée de plusieurs Etape.
Relation N-N : Recette_Ingredient relie les tables Recette et Ingredient, avec une quantité et une unité associées à chaque lien.


Tables principales : Utilisateur, Profil, Recette, Categorie, Ingredient, Recette_Ingredient, Etape, Avis.

Installation


Cloner le dépôt
Lancer XAMPP (Apache + MySQL)
Créer une base de données nommée SAE_BDD_PW dans phpMyAdmin
Importer les fichiers SQL dans l'ordre suivant :

recette.sql (création des tables)
ingredients.sql (liste des ingrédients)
data.sql (données de démonstration : recettes, étapes, utilisateur de test)



Placer le dossier du projet dans htdocs
Accéder à l'application via : http://localhost/SAE_BDD_PW/projet/index.php


Compte de test

Pour tester les fonctionnalités nécessitant une connexion (poster un avis, déconnexion) :


Email : test@test.fr
Mot de passe : password


Fonctionnalités


Consultation de la liste des recettes
Recherche de recettes par titre
Filtre des recettes par catégorie
Consultation détaillée d'une recette (ingrédients, étapes)
Inscription et connexion utilisateur
Ajout d'une nouvelle recette (réservé aux utilisateurs connectés)
Système d'avis (note + commentaire) réservé aux utilisateurs connectés


Équipe


Raphaël — Schéma de la base de données, page d'accueil avec liste des recettes, recherche et filtre par catégorie, relecture transversale du code

Babacar — Structure du projet, connexion PDO, page détail d'une recette, système d'avis, fonctionnalité d'ajout de recette, charte graphique

Mohamed — Import des données (ingrédients et recettes), authentification (inscription/connexion), navigation et gestion de session, documentation


Tous les membres de l'équipe ont contribué en tant que développeurs full-stack sur l'ensemble du projet (PHP, MySQL, Bootstrap).
