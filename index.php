<?php
require_once("dependencies/phpQuery/phpQuery.php");
require_once("functions/connectDB.php");

// Charger le modèle HTML à partir d'un fichier
$html = file_get_contents("template.html");

// Créer une instance phpQuery et charger le modèle HTML
$doc = phpQuery::newDocument($html);

// Récupérer les éléments depuis la base de données
try {
    global $pdo;

    // Préparer et exécuter la requête pour récupérer les éléments de la base de données
    $stmt = $pdo->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($items) {
        $itemList = $doc["#itemList"];

        // Parcourir les éléments récupérés et les ajouter à la liste
        foreach ($items as $item) {
            $itemId = $item['id'];
            $itemName = $item['name'];
            $itemDescription = $item['description'];
            $itemPrice = $item['price'];

            // Créer un nouvel élément de liste avec un identifiant unique
            $li = "<li id='item_$itemId'>
                        <strong>$itemName</strong>: $itemDescription - Prix: $itemPrice 
                        <a href=\"#\" class=\"item-details-link\" data-id=\"$itemId\">Voir détails</a>
                        <button onclick=\"confirmDelete($itemId)\">Supprimer</button>
                    </li>";

            $itemList->append($li);
        }
    } else {
        echo "Aucun item trouvé en BDD";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Afficher le HTML modifié
echo $doc->html();
?>
