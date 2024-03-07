<?php
require_once("connectDB.php");

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    try {
        global $pdo;

        // Préparer et exécuter la requête pour supprimer l'élément de la base de données
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = :id");
        $stmt->bindValue(':id', $itemId, PDO::PARAM_INT);
        $stmt->execute();
        http_response_code(200);
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erreur lors de la suppression de l'élément: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "L'identifiant de l'élément est manquant dans la requête";
}
?>

