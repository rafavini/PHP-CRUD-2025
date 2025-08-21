<?php
include_once __DIR__ . "/enum.php";
include_once __DIR__ . "/../../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();


function genereteCsrf()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['csrfToken'])) {
        unset($_SESSION['csrfToken']);
    }

    if (!isset($_SESSION['csrfToken'])) {
        $_SESSION['csrfToken'] = md5(uniqid(32));
    }
    return '<input type="hidden" id="csrfToken" name="csrfToken" value="' . $_SESSION['csrfToken'] . '">';
}
function validateTokenCsrf($token)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['csrfToken'])) {
        echo json_encode(['error' => 'falta do csrf token']);
        exit;
    }

    if ($_SESSION['csrfToken'] !== $token) {
        echo json_encode(['error' => 'csrf token inválido']);
        exit;
    }

    unset($_SESSION['csrfToken']);

    return TRUE;
}


function MapRole($role){
    return match($role){
        Role::ADMIN => "admin",
        Role::PROFESSOR => "professor",
    };
}


function isUserAuthenticate(){
    return isset($_SESSION['userAuth']);
}



function RequireAuth(string $requireRole){
    if(!isUserAuthenticate()){
        header("Location: ". $_ENV["BASE_URL"]);
    }
}






function ValidateRole($userRole,$validateRole){

    if($userRole == $validateRole){
        // $_SESSION['toast'] = ['type' => 'error', 'message' => 'Nao tem permissão para acessar essa pagina'];
        return true;
    }else{
        return false;
    }   
}

function ValidateUserSession(){
    if(isset($_SESSION['userAuth'])){
        // $_SESSION['toast'] = ['type' => 'error', 'message' => 'Nao tem permissão para acessar essa pagina'];
        return true;
    }else{
        return false;
    }
}


function ValidadePage($validationRole){

    if(!isset($_SESSION['userAuth'])){
        echo "sem auth";
        // header("Location: /index.php");
    }

    // if (!ValidateRole(isset($_SESSION['userAuth']['role']), $validationRole)) {
    //     header("Location: /index.php");
    // }
}
