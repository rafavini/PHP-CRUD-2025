<?php

define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'turma31');
define('BASE_URL', '/mvc/');



//roles
enum roles: int {
    case adm = 1;
    case funcionario = 2;
}

function checkAuth(roles $roleToConfirm)
{
    // session_start();
    if (!isset($_SESSION['userAuth'])) {
        http_response_code(403);
        echo "Você precisa estar logado.";
        header('Location: /mvc');
    }


    if($_SESSION['userAuth']['role'] != $roleToConfirm->value){
        echo "nao tem permissao para entrar nessa tela.";
        return false;
        // header("Location: /mvc");
    }else{
        return true;
    }
}

?>