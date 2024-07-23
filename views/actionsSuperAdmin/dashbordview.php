<?php
require_once __DIR__ . '/../../_config/db.php';

try {
    // Vérifiez le nombre de clients
    $stmt = $database->prepare("SELECT COUNT(*) AS count FROM clients");
    $stmt->execute();
    $clientCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Vérifiez le nombre de produits
    $stmt = $database->prepare("SELECT COUNT(*) AS count FROM produits");
    $stmt->execute();
    $productCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Vérifiez le nombre d'admins
    $stmt = $database->prepare("SELECT COUNT(*) AS count FROM users");
    $stmt->execute();
    $adminCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Vérifiez le nombre de stocks (définit la variable $totalStock si besoin)
    $stmt = $database->prepare("SELECT SUM(stock) AS total_stock FROM produits");
    $stmt->execute();
    $totalStock = $stmt->fetch(PDO::FETCH_ASSOC)['total_stock'];

    // Vérifiez le nombre total de commandes
    $stmt = $database->prepare("SELECT COUNT(*) AS total_commandes FROM commandes");
    $stmt->execute();
    $totalCommandes = $stmt->fetch(PDO::FETCH_ASSOC)['total_commandes'];

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <script src="public/assets/js/script.js> </script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
        <img src="../../public/logo/logo.jpg" alt="Logo" class="logo">

            <ul>
                <li><a href="../listProduits.php">Gestion des produits</a></li>
                <li><a href="../addProduct.php">Ajouter des produits</a></li>
                <li><a href="gestion_commandes.php">Gestion des commandes</a></li>
                <li><a href="../userview.php">Liste des utilisateurs</a></li>
                <li><a href="modifierUser.php">Modifier l'Administrateur</a></li>
                <li><a href="supprimerUser.php">Supprimer l'Administrateur</a></li>
                <li><a href="../deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>
        <div class="main">
            <h2>Tableau de bord du super administrateur</h2>
            <div class="header">
                <form action="../recherche.php" method="get">
                    <input type="text" name="query" placeholder="Rechercher des produits...">
                    <button type="submit">Rechercher</button>
                </form>
            </div>
            <div class="content">
                <div class="box oval">
                    <h3>Nombres de clients</h3>
                    <p><?php echo htmlspecialchars($clientCount); ?></p>
                </div>
                <div class="box oval">
                    <h3>Nombres de produits</h3>
                    <p><?php echo htmlspecialchars($productCount); ?></p>
                </div>
                <div class="box oval">
                    <h3>Nombres d'admins</h3>
                    <p><?php echo htmlspecialchars($adminCount); ?></p>
                </div>
                <div class="box oval">
                    <h3>Nombres de stocks</h3>
                    <p><?php echo htmlspecialchars($totalStock); ?></p>
                </div>
                <div class="box oval">
                    <h3>Évolution des commandes</h3>
                    <!-- Contenu provenant de la base de données -->
                </div>
                <div class="box oval">
                    <h3>Nombre total de commandes</h3>
                    <p><?php echo htmlspecialchars($totalCommandes); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        &copy; 2024 Société Bah & Frères. Tous droits réservés.
    </div>
</body>
</html>
