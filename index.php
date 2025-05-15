<?php

require_once './app/Controllers/baseController.php';
require_once './app/config/config.php';
require_once './app/config/database.php';

require_once './app/Controllers/homeController.php';
require_once './app/Controllers/loginController.php';

$homeController = new HomeController();
$loginController = new LoginController();
session_start();

require_once 'routes.php';


Router::get('/', function () use ($loginController) {
    $loginController->index();
});

Router::get('/home', function () use ($homeController) {
    checkAuth();
    $homeController->index();
});

Router::get('/cadastro', function () use ($homeController) {
    checkAuth();
    $result = checkRole(roles::ADM);

    if ($result) {
        $homeController->AddUser();
    } else {
        echo "nao tem permissao";
    }
});
Router::get('/edit/(\d+)', function ($id) use ($homeController) {
    checkAuth();
    $result = checkRole(roles::ADM);

    if ($result) {
        $homeController->EditUser($id);
    } else {
        echo "nao tem permissao";
    }
});


// api
Router::post('/api/login', function () use ($loginController) {
    $loginController->login();
});
Router::post('/api/addUser', function () use ($homeController) {
    $homeController->AddUser();
});
Router::post('/api/editUser/(\d+)', function ($id) use ($homeController) {
    $homeController->EditUser($id);
});


Router::dispatch();
