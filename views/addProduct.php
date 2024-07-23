<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un Produit</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
    </style>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="createProduct">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="price">Prix:</label>
        <input type="number" step="0.01" id="price" name="price" required>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>
        <label for="image_url">URL de l'image:</label>
        <input type="url" id="image_url" name="image_url" required>
        <label for="category_id">Catégorie:</label>
        <select id="category_id" name="category_id" required>
            <!-- Les differents catégories de chaussures du père de Gando -->
            <option value="1">Sandales Traditionnelles</option>
            <option value="2">Bottes en Cuir</option>
            <option value="3">Chaussures de Mariage</option>
            <option value="4">Ballerines Africaines</option>
            <option value="5">Chaussures en Tissu Wax</option>
            <option value="6">Espadrilles Africaines</option>
            <option value="7">Mocassins Traditionnels</option>
            <option value="8">Chaussures de Travail en Cuir</option>
            <option value="9">Sandales en Perles</option>
            <option value="10">Babouches Africaines</option>
            <option value="11">Chaussures pour Enfants</option>
            <option value="12">Chaussures de Sport</option>
        </select>
        <button type="submit">Ajouter Produit</button>
    </form>
</body>
</html>
