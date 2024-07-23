<?php

class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function showUser($id) {
        $user = $this->model->getUserById($id);
        if ($user) {
            include 'views/userview.php';
        } else {
            echo "ERREUR";
        }
    }

    public function showAllUsers() {
        $users = $this->model->getAllUsers();
        include 'views/userview.php';
    }

    public function createUser($data) {
        if (!empty($data['prenom']) && !empty($data['email'])) {
            if ($this->model->createUser($data)) {
                $this->showAllUsers();
            } else {
                echo "Une erreur s'est produite";
            }
        }
    }

    public function updateUser($id, $data) {
        if ($this->model->updateUser($id, $data)) {
            $this->showAllUsers();
        } else {
            echo "Une erreur s'est produite lors de la mise à jour de l'utilisateur.";
        }
    }

    public function deleteUser($id) {
        if ($this->model->deleteUser($id)) {
            $this->showAllUsers();
        } else {
            echo "Une erreur s'est produite lors de la suppression de l'utilisateur.";
        }
    }
}
