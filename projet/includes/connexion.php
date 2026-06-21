<?php
    try 
    {
        $pdo = new PDO
        (
            'mysql:host=localhost;dbname=SAE_BDD_PW;charset=utf8',
            'root',      // utilisateur MySQL par défaut sur XAMPP
            '',          // mot de passe vide par défaut sur XAMPP
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    } 
    catch (PDOException $e) 
    {
        die('Erreur de connexion : ' . $e->getMessage());
    }
?>