<?php
require_once("connectDB.php");

if(isset($_GET['id'])) {
    $itemId = $_GET['id'];

    try {
        // Préparer et exécuter la requête SQL pour récupérer les détails de l'élément avec l'identifiant $itemId
        $stmt = $pdo->prepare("SELECT name, description, price FROM items WHERE id = :id");
        $stmt->bindParam(':id', $itemId);
        $stmt->execute();
        $itemDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($itemDetails) {
            // Convertir les détails de l'élément en format JSON et renvoyer la réponse
            header('Content-Type: application/json');
            echo json_encode($itemDetails);
        } else {
            echo json_encode(array('error' => 'Aucun élément correspondant trouvé dans la base de données'));
        }
    } catch (PDOException $e) {
        echo json_encode(array('error' => 'Erreur lors de la récupération des détails de l\'élément depuis la base de données: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('error' => 'Aucun identifiant d\'élément fourni'));
}
?>
