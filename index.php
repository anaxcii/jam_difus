<?php

require_once("dependencies/phpQuery/phpQuery.php");
require_once("functions/connectDB.php");
require_once ("repository/ItemRepository.php");


// Charger le modèle HTML à partir d'un fichier
$html = file_get_contents("template.html");

// Créer une instance phpQuery et charger le modèle HTML
$doc = phpQuery::newDocument($html);

// Récupérer les éléments depuis la base de données
try {
    $items = ItemRepository::getItems();

    if ($items) {
        $itemList = $doc["#itemList"];

        // Parcourir les éléments récupérés et les ajouter à la liste
        foreach ($items as $item) {
            $itemId = $item->getId();
            $itemName = $item->getName();
            $itemDescription = $item->getDescription();
            $itemPrice = $item->getPrice();

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
