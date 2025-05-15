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

    
Router::get('/', function () use ($loginController){
    $loginController->index();
});

Router::get('/home', function () use ($homeController){
    $result = checkAuth(roles::adm);

    if($result){
        $homeController->index();
    }else{
        echo "nao tem permissao";
    }
});

Router::get('/cadastro', function () use ($homeController){
    $result = checkAuth(roles::adm);

    if($result){
        $homeController->AddUser();
    }else{
        echo "nao tem permissao";
    }
});
Router::get('/edit/(\d+)', function ($id) use ($homeController){
    $result = checkAuth(roles::adm);

    if($result){
        $homeController->EditUser($id);
    }else{
        echo "nao tem permissao";
    }
});


// api
Router::post('/api/login', function () use ($loginController){
    $loginController->login();
});
Router::post('/api/addUser', function () use ($homeController){
    $homeController->AddUser();
});
Router::post('/api/editUser/(\d+)', function ($id) use ($homeController){
    $homeController->EditUser($id);
});


Router::dispatch();

// $request = $_SERVER['REQUEST_URI'];
// $request = str_replace('/mvc', '', $request);


// $found = false;

// foreach($routes as $pattern => $callback) {
//     $patternRegex = "#^" . $pattern . "$#";

//     if(preg_match($patternRegex, $request, $matches)){
//         array_shift($matches);
//         call_user_func_array($callback, $matches);

//         $found = true;
//         break;
//     }
// }

// if(!$found){
//     http_response_code(404);
//     echo "pagina nao encontrada";
// }