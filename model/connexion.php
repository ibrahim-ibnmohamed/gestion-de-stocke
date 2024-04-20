<?php

session_start();

$nom_server = "localhost";
$nom_bdd = "gestion";
$utilisateur = "root";
$mot_de_pass = "root";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
];

try {
    $connexion = new PDO("mysql:host=$nom_server;port=3306;dbname=$nom_bdd;charset=utf8mb4", $utilisateur, $mot_de_pass, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Autres codes liés à la connexion à la base de données ou à toute autre fonctionnalité

// Vous pouvez utiliser $connexion pour exécuter des requêtes PDO dans le reste de votre script
