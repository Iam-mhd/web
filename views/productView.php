<!DOCTYPE html>
<html>
<head>
    <title>Tous Les Produits</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <h1>Bah & Frères</h1>
    <?php if (!empty($products)): ?>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Prix: <?php echo htmlspecialchars($product['price']); ?> FCFA</p>
                    <p>Stock: <?php echo htmlspecialchars($product['stock']); ?></p>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="pagination-link"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>Aucun produit trouvé</p>
    <?php endif; ?>
</body>
</html>
