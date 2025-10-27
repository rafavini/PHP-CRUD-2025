<?php

require_once __DIR__ . "/../models/LoginModel.php";

$loginModel = new LoginModel();

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':

        $result = $loginModel->Auth($_POST["username"], $_POST["password"]);
        if($result){
            echo json_encode(["result" => $result]);
        }else{
            http_response_code(404);
            echo json_encode("usuario nao encontrado");
        }
        break;
    case 'GET':
        echo json_encode(["teste" => 1]);
        break;


    default:
        # code...
        break;
}
