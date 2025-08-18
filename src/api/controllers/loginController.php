<?php
require_once __DIR__ . "/../../utils/csrf.php";
require_once __DIR__ . "/../models/loginModel.php";

$loginController = new LoginModel();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['csrfToken'])) {
    //validar o csrfToken
    validateTokenCsrf($_POST['csrfToken']);
    $result = $loginController->Auth($_POST);
    if ($result) {
        // Login successful
        echo json_encode(['data' => $result, 'success' => true, 'message' => 'Login successful']);
        // echo json_encode(['success' => $_POST]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method or missing CSRF token']);
    exit;
}
