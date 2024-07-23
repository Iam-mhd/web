<?php

require_once '../../_config/db.php'; 
require_once '../../models/usermodel.php';
require_once '../../controllers/usercontroller.php';

$userModel = new UserModel($database);
$userController = new UserController($userModel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_user'];
    $data = [
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'telephone' => $_POST['telephone'],
        'email' => $_POST['email']
    ];

    $userController->updateUser($id, $data);
} else {
    echo "Méthode non autorisée.";
}
?>
