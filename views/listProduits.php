<?php
// Importer les dépendances
require_once '../_config/db.php';
require_once '../models/productmodel.php';
require_once '../controllers/productcontroller.php';


// Démarrer la session
session_start();

// Initialiser le modèle et le contrôleur pour les produits
$productModel = new ProductModel($database);
$productController = new ProductController($productModel);

// Gestion des actions de produit (ajouter, modifier, supprimer)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $productId = $_POST['product_id'] ?? null;

        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'stock' => $_POST['stock'],
            'image_url' => $_POST['image_url'],
            'category_id' => $_POST['category_id']
        ];

        switch ($action) {
            case 'add':
                $productController->createProduct($data);
                break;
            case 'update':
                $productController->updateProduct($productId, $data);
                break;
            case 'delete':
                $productController->deleteProduct($productId);
                break;
        }
    }
    header('Location: listProduits.php');
    exit;
}

$products = $productController->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Produits</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <h1>Gestion des Produits</h1>
    <div class="products">
        <div class="add-product">
            <a href="addProduct.php"><button type="submit">Ajouter Un nouveau Produit</button></a>
        
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <div class="product-info">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <span><?php echo htmlspecialchars($product['name']); ?></span>
                        <span><?php echo htmlspecialchars($product['description']); ?></span>
                        <span>Prix: <?php echo htmlspecialchars($product['price']); ?> FCFA</span>
                        <span>Stock: <?php echo htmlspecialchars($product['stock']); ?></span>
                        <span>Catégorie: <?php echo htmlspecialchars($product['category_id']); ?></span>
                    </div>
                    <form action="listProduits.php" method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" required>
                        <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                        <input type="number" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
                        <input type="text" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>" required>
                        <input type="number" name="category_id" value="<?php echo htmlspecialchars($product['category_id']); ?>" required>
                        <button type="submit">Mettre à jour</button>
                    </form>
                    <form action="listProduits.php" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="delete-button">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun produit trouvé</p>
        <?php endif; ?>
    </div>
</body>
</html>
