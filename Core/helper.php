<?php
include_once __DIR__ . "/enum.php";
include_once __DIR__ . "/../vendor/autoload.php";
include_once __DIR__ . "/../components/alerts.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
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
        Role::ALUNO => "aluno",
    };
}


function isUserAuthenticate(){
    return isset($_SESSION['userAuth']);
}


function RequireAuth(string $requireRole){
    if(!isUserAuthenticate()){
        setToast("Acesso negado. Faça login para continuar.", "error");
        header("Location: ". $_ENV["BASE_URL"]);
    }


    $userRole = $_SESSION['userAuth']['role'];
    if($userRole !== $requireRole){
        setToast("Acesso negado. Você não tem permissão para acessar esta página.", "error");
        header("Location: ". $_ENV["BASE_URL"]);
    }

}


