<?php

require_once './app/Controllers/baseController.php';
require_once './app/config/config.php';
require_once './app/config/database.php';

require_once './app/Controllers/homeController.php';
require_once './app/Controllers/loginController.php';
require_once './app/Controllers/userController.php';

$homeController = new HomeController();
$loginController = new LoginController();
$userController = new UserController();
session_start();

require_once 'routes.php';


Router::get('/', function () use ($loginController) {
    $loginController->index();
});

Router::get('/home', function () use ($homeController) {
    checkAuth();
    $homeController->index();
});

Router::get('/cadastro', function () use ($userController) {
    checkAuth();
    $result = checkRole(roles::ADM);

    if ($result) {
        $userController->AddPage();
    } else {
        echo "nao tem permissao";
    }
});
Router::get('/edit/(\d+)', function ($id) use ($userController) {
    checkAuth();
    $result = checkRole(roles::ADM);

    if ($result) {
        $userController->EditPage($id);
    } else {
        echo "nao tem permissao";
    }
});

Router::get('/gerenciarUsuario', function () use ($userController) {
    checkAuth();
    $result = checkRole(roles::ADM);

    if ($result) {
        $userController->GerenciarUsuarioPage();
    } else {
        echo "nao tem permissao";
    }
});


// api
Router::post('/api/login', function () use ($loginController) {
    $loginController->login();
});
Router::post('/api/addUser', function () use ($userController) {
    $userController->AddPage();
});
Router::post('/api/editUser/(\d+)', function ($id) use ($userController) {
    $userController->EditPage($id);
});


Router::dispatch();
