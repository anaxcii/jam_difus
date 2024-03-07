<?php
require_once("connectDB.php");

function populateDatabase() {
    global $pdo;

    try {
        // Vérifiez si la table existe déjà
        $stmt_check_table = $pdo->query("SHOW TABLES LIKE 'items'");
        $table_exists = $stmt_check_table->fetchColumn();

        if (!$table_exists) {
            // Créer la table si elle n'existe pas
            $sql_create_table = "CREATE TABLE items (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT,
                price DECIMAL(10, 2) NOT NULL
            )";
            $pdo->exec($sql_create_table);
            echo "Table 'items' crée.<br>";
        }

        // Générer un nouvel item avec des valeurs aléatoires
        $name = "Produit " . rand(1, 1000);
        $description = "Description du " . $name;
        $price = rand(10, 100);

        // Insérer le nouvel item dans la table items
        $sql_insert_data = "INSERT INTO items (name, description, price) VALUES (:name, :description, :price)";
        $stmt_insert_data = $pdo->prepare($sql_insert_data);
        $stmt_insert_data->bindParam(':name', $name);
        $stmt_insert_data->bindParam(':description', $description);
        $stmt_insert_data->bindParam(':price', $price);
        $stmt_insert_data->execute();

        echo "Nouvel item inseré: " . $name;
    } catch (PDOException $e) {
        throw new InvalidArgumentException('Erreur lors du peuplement de la base de données : '.$e->getMessage());
    }
}

populateDatabase();
?>
