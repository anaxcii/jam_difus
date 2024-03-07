<?php

try {
    $host = 'localhost';
    $dbName = 'jamdifus';
    $user = 'root';
    $password = '';

    // Connexion à MySQL sans spécifier la base de données
    $pdo = new PDO(
        'mysql:host='.$host.';charset=utf8',
        $user,
        $password);

    // Création de la base de données 'jamdifus' si elle n'existe pas
    $pdo->exec("CREATE DATABASE IF NOT EXISTS jamdifus");

    // Sélectionner la base de données 'jamdifus' pour les prochaines requêtes
    $pdo->exec("USE jamdifus");

    // Connexion à la base de données 'jamdifus'
    $pdo = new PDO(
        'mysql:host='.$host.';dbname='.$dbName.';charset=utf8',
        $user,
        $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    throw new InvalidArgumentException('Erreur connexion à la base de données : '.$e->getMessage());
    exit;
}

?>
