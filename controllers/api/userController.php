<?php
require_once __DIR__ . '/../../Core/helper.php';
require_once __DIR__ . '/../../components/alerts.php';
require_once __DIR__ . '/../../models/userModel.php';



class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new userModel();
    }

    public function createUser()
    {
        if (isset($_POST['csrfToken'])) {
            validateTokenCsrf($_POST['csrfToken']);
            $result = $this->userModel->CreateUser($_POST);
            if ($result) {
                setToast("Usuario cadastrado com sucesso!", "success");
                http_response_code(201);
                echo json_encode([
                    'success' => true,
                ]);
            } else {
                http_response_code(400);
                setToast("Não foi possivel realizar o cadastro do usuario", "error");
                echo json_encode(['success' => false]);
            }
        } else {
            setToast("Acesso negado. Faça login para continuar.", "error");
            echo json_encode(['error' => 'Invalid request method or missing CSRF token']);
            exit;
        }
    }
}
