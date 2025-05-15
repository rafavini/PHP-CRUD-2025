<?php


class LoginController extends BaseController
{
    public function index()
    {
        require_once './app/views/login/index.php';
    }

    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $model = $this->loadModel('loginModel');
            $result = $model->Auth($_POST["username"], $_POST["password"]);
            if ($result) {
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Login bem-sucedido!'];
                header('Location: /mvc/home');
            }
        }
    }
}
