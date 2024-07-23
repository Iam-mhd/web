<?php
// Importer les dépendances
require_once '_config/db.php';
require_once 'models/usermodel.php';
require_once 'controllers/usercontroller.php';
require_once 'models/productModel.php';
require_once 'controllers/productController.php';
require_once 'models/categoriModel.php'; 
require_once 'controllers/categoriController.php';
require_once 'views/includes/head.php';

session_start();

// Gestion des connexions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification pour les utilisateurs
    $tableUser = "SELECT * FROM users WHERE email = :email AND mot_de_passe = :password";
    $requete = $database->prepare($tableUser);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':password', $password);
    $requete->execute();
    $user = $requete->fetch();

    if ($user) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['email'] = $user['email'];
        header('Location: index.php');
        exit;
    } else {
        // Vérification pour les super utilisateurs
        $tableSuperUser = "SELECT * FROM superuser WHERE email = :email AND mot_de_passe = :password";
        $requete = $database->prepare($tableSuperUser);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->execute();
        $superUser = $requete->fetch();

        if ($superUser) {
            $_SESSION['id_superUser'] = $superUser['id_superUser'];
            $_SESSION['email'] = $superUser['email'];
            header('Location: index.php'); 
            exit;
        } else {
            $message = "Adresse e-mail ou mot de passe incorrect.";
        }
    }
}

// Gestion de l'ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Ajouter le produit au panier
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }

    header('Location: index.php');
    exit;
}

// Inclure l'en-tête approprié en fonction du type d'utilisateur
if (isset($_SESSION['id_superUser'])) {
    require_once 'views/includes/headerSuperAdmin.php';
} elseif (isset($_SESSION['id_user'])) {
    require_once 'views/includes/headerAdmin.php';
} else {
    require_once 'views/includes/headerUser.php';
}

// Initialiser le modèle et le contrôleur pour les utilisateurs
$userModel = new UserModel($database);
$userController = new UserController($userModel);

// Vérifier l'action demandée
if (isset($_GET['action']) && $_GET['action'] === 'manageUsers') {
    $userController->showAllUsers();
    exit; // Sortir pour éviter d'afficher le reste de la page
}



// Initialiser le modèle et le contrôleur pour les catégories
$categoryModel = new CategoryModel($database);
$categoryController = new CategoryController($categoryModel);
$categories = $categoryModel->getAllCategories(); // Obtenir toutes les catégories



?>

    <div class="container">
        <div class="category-view">
            <?php include 'views/categoriView.php'; ?>
        </div>
        <div class="product-view">
            <?php 
            // Initialiser le modèle et le contrôleur pour les produits
            $productModel = new ProductModel($database);
            $productController = new ProductController($productModel);
            $productController->showAllProducts();
            ?>
        </div>
    </div>

