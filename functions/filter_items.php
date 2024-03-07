<?php
require_once("connectDB.php");

// Récupérer les paramètres de filtrage depuis la requête GET
$filterName = isset($_GET['name']) ? '%' . $_GET['name'] . '%' : '%';
$filterPrice = isset($_GET['price']) ? $_GET['price'] : 0;

try {
    global $pdo;

    // Préparer la requête pour récupérer les éléments filtrés de la base de données
    $sql = "SELECT * FROM items WHERE (name LIKE :name OR :name = '%') AND (price <= :price OR :price = 0)";
    $stmt = $pdo->prepare($sql);

    // Liaison des valeurs des paramètres de filtrage à la requête
    $stmt->bindValue(':name', $filterName, PDO::PARAM_STR);
    $stmt->bindValue(':price', $filterPrice, PDO::PARAM_INT);

    $stmt->execute();

    // Récupérer les éléments filtrés sous forme de tableau
    $filteredItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convertir les données d'éléments filtrés en format JSON et les renvoyer
    header('Content-Type: application/json');
    echo json_encode($filteredItems);
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Erreur lors de la récupération des éléments filtrés: ' . $e->getMessage()));
}
?>
