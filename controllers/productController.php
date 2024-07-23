<?php

class ProductController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function showProduct($id) {
        $product = $this->model->getProductById($id);
        if ($product) {
            include 'views/productview.php';
        } else {
            echo "ERREUR";
        }
    }

    public function showAllProducts($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $products = $this->model->getAllProducts($limit, $offset);
        $totalProducts = $this->model->countProducts();
        $totalPages = ceil($totalProducts / $limit);

        include 'views/productView.php';
    }

    public function getAllProducts() {
        return $this->model->getAllProducts(100, 0); // Par exemple, obtenir les 100 premiers produits.
    }

    public function createProduct($data) {
        if (!empty($data['name']) && !empty($data['price']) && !empty($data['stock']) && !empty($data['image_url']) && !empty($data['category_id'])) {
            if ($this->model->createProduct($data)) {
                // actualiser la page
                $this->showAllProducts();
                exit;
            } else {
                echo "Une erreur s'est produite";
            }
        }
    }
    
    public function updateProduct($id, $data) {
        if (!empty($data['name']) && !empty($data['price']) && !empty($data['stock']) && !empty($data['image_url']) && !empty($data['category_id'])) {
            if ($this->model->updateProduct($id, $data)) {
                // actualiser la page
                $this->showAllProducts();
                exit;
            } else {
                echo "Une erreur s'est produite";
            }
        }
    }

    public function deleteProduct($id) {
        if ($this->model->deleteProduct($id)) {
            // actualiser la page
            $this->showAllProducts();
            exit;
        } else {
            echo "Une erreur s'est produite";
        }
    }
}
?>
