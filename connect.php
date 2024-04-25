<?php
// Définition des constantes pour les informations de connexion à la base de données
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'db_blog');

// Connexion à la base de données
try {
    $conn = new PDO ("mysql:host=".SERVERNAME.";dbname=".DATABASE, USERNAME, PASSWORD);
    // Définition du mode de gestion des erreurs : PDO::ERRMODE_EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch(PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
} 
?>