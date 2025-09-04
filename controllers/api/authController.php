<?php
require_once __DIR__ . '/../../Core/helper.php';
require_once __DIR__ . '/../../components/alerts.php';
require_once __DIR__ . '/../../models/loginModel.php';


class AuthController
{
    private $loginController;

    public function __construct()
    {
        $this->loginController = new LoginModel();
    }

    public function index() {}

    public function authenticate()
    {

        if (isset($_POST['csrfToken'])) {
            validateTokenCsrf($_POST['csrfToken']);
            $result = $this->loginController->Auth($_POST);
            if ($result) {
                // Login successful
                setToast("Login realizado com sucesso", "success");
                echo json_encode(['data' => $result, 'success' => true, 'message' => 'Login successful']);
                // echo json_encode(['success' => $_POST]);
            } else {
                // Login failed
                setToast("Credenciais inválidas", "error");
                echo json_encode(['error' => 'Invalid credentials', 'success' => false]);
            }
        } else {
            setToast("Acesso negado. Faça login para continuar.", "error");
            echo json_encode(['error' => 'Invalid request method or missing CSRF token']);
            exit;
        }
    }
}
