<?php
// delete_user.php

require_once '../../_config/db.php'; 
require_once '../../models/usermodel.php';
require_once '../../controllers/usercontroller.php';

$database = new Database(); 
$model = new UserModel($database);
$controller = new UserController($model);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_user'];
    $controller->deleteUser($id);
} else {
    echo "Méthode non autorisée.";
}
?>
