<?php
require_once __DIR__ . '/../models/userModel.php';

class AdminController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        RequireAuth("admin");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $offset = ($page - 1) * $limit;

        $users = $this->userModel->getAllUser($limit,$offset);
        
        require __DIR__ . '/../views/admin/home.php';
    }


    public function createUserView(){
        RequireAuth("admin");
        require __DIR__ . '/../views/admin/createUser.php';
    }
}
