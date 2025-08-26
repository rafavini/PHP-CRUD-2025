<?php
require_once __DIR__ . "/../../utils/utils.php";
require_once __DIR__ . "/../../utils/alerts.php";
require_once __DIR__ . "/../models/userModel.php";

$userController = new UserModel();


if($_SERVER["REQUEST_METHOD"] == "GET"){
    $result = $userController->GetAllUsers();
    if ($result) {
        // Fetch successful
        echo json_encode(['data' => $result["users"], 'success' => true, 'message' => 'Fetch successful', 'totalUsers' => $result["totalUsers"]]);
    }else{
        // Fetch failed
        setToast("Nenhum usuário encontrado", "error");
        echo json_encode(['error' => 'No users found', 'success' => false]);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['csrfToken'])) {

    //validar o csrfToken
    validateTokenCsrf($_POST['csrfToken']);
    $result = $userController->CreateUser($_POST);
    if($result){
        // Create successful
        setToast("Usuário criado com sucesso", "success");
        echo json_encode(['success' => $result, 'message' => 'User created successfully']);
    }else{
        // Create failed
        setToast("Erro ao criar usuário", "error");
        echo json_encode(['error' => 'Error creating user', 'success' => false]);
    }

    // $result = $loginController->Auth($_POST);
//     if ($result) {
//         // Login successful
//         setToast("Login realizado com sucesso", "success");
//         echo json_encode(['data' => $result, 'success' => true, 'message' => 'Login successful']);
//         // echo json_encode(['success' => $_POST]);
//     }else{
//         // Login failed
//         setToast("Credenciais inválidas", "error");
//         echo json_encode(['error' => 'Invalid credentials', 'success' => false]);
//     }
}