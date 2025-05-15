<?php

define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'turma31');
define('BASE_URL', '/php-crud-2025/');
define('UserAuth', 'userAuth');


//roles
class Roles {
    const ADM = 1;
    const FUNCIONARIO = 2;
}

function checkAuth()
{
    // session_start();
    if (!isset($_SESSION['userAuth'])) {
        http_response_code(403);
        echo "Você precisa estar logado.";
        header('Location:'. BASE_URL);
    }
}


function checkRole($roleToConfirm){
    if($_SESSION['userAuth']['role'] != $roleToConfirm){
        return false;
        // header("Location: /mvc");
    }else{
        return true;
    }
}

?>