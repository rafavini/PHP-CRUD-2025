<?php
require_once __DIR__ . "/../../utils/utils.php";
require_once __DIR__ . "/../../utils/alerts.php";
require_once __DIR__ . "/../models/loginModel.php";

$loginController = new LoginModel();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['csrfToken'])) {

    //validar o csrfToken
    validateTokenCsrf($_POST['csrfToken']);
    $result = $loginController->Auth($_POST);
    if ($result) {
        // Login successful
        setToast("Login realizado com sucesso", "success");
        echo json_encode(['data' => $result, 'success' => true, 'message' => 'Login successful']);
        // echo json_encode(['success' => $_POST]);
    }else{
        // Login failed
        setToast("Credenciais inválidas", "error");
        echo json_encode(['error' => 'Invalid credentials', 'success' => false]);
    }
} else {
    setToast("Acesso negado. Faça login para continuar.", "error");
    echo json_encode(['error' => 'Invalid request method or missing CSRF token']);
    exit;
}
