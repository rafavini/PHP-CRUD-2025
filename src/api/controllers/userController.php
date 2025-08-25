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
