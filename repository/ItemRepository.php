<?php

use classes\Item;

require_once("functions/connectDB.php");
require_once ("class/Item.php");

class ItemRepository
{
     public static function getItems()
     {
         global $pdo;

         // Préparer et exécuter la requête pour récupérer les éléments de la base de données
         $stmt = $pdo->query("SELECT * FROM items");
         $bdd_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $items=[];
         foreach ($bdd_items as $bdd_item){
             $items[] = Item::convertItem($bdd_item);
         }
         return($items);
     }
}