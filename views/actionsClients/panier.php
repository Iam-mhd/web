<?php
// Importer les dépendances
require_once '../../_config/db.php';
require_once '../../models/productmodel.php';
require_once '../../controllers/productcontroller.php';

// Démarrer la session
session_start();

// Initialiser le modèle et le contrôleur pour les produits
$productModel = new ProductModel($database);
$productController = new ProductController($productModel);

// Gestion de l'ajout et de la suppression de la quantité des produits dans le panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $productId = $_POST['product_id'];

        if ($_POST['action'] === 'increase') {
            $_SESSION['cart'][$productId]++;
        } elseif ($_POST['action'] === 'decrease') {
            $_SESSION['cart'][$productId]--;
            if ($_SESSION['cart'][$productId] < 1) {
                unset($_SESSION['cart'][$productId]);
            }
        }
    }
}

// Récupérer les informations des produits dans le panier
$productsInCart = [];
$totalPrice = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = $productModel->getProductById($productId);
        if ($product) {
            $product['quantity'] = $quantity;
            $product['total_price'] = $product['price'] * $quantity;
            $totalPrice += $product['total_price'];
            $productsInCart[] = $product;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panier</title>
    <link rel="stylesheet" href="<link rel="stylesheet" href="../../public/assets/css/style.css">">
</head>
<body>
    <h1>Votre Panier</h1>
    <div class="cart">
        <?php if (!empty($productsInCart)): ?>
            <?php foreach ($productsInCart as $product): ?>
                <div class="cart-item">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div>
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                        <p>Prix: <?php echo htmlspecialchars($product['price']); ?> FCFA</p>
                        <p>Total: <?php echo htmlspecialchars($product['total_price']); ?> FCFA</p>
                    </div>
                    <div class="quantity">
                        <form action="panier.php" method="POST">
                            <input type="hidden" name="action" value="decrease">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit">-</button>
                        </form>
                        <p><?php echo htmlspecialchars($product['quantity']); ?></p>
                        <form action="panier.php" method="POST">
                            <input type="hidden" name="action" value="increase">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit">+</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="total-price">
                <p>Total à payer: <?php echo htmlspecialchars($totalPrice); ?> FCFA</p>
            </div>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
    </div>
</body>
</html>
