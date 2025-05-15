<?php


class HomeController extends BaseController
{
    public  function index()
    {
        $nome = "rafael";

        $model = $this->loadModel('BookModel');

        $this->renderView("home/index", ["data" => $nome]);
        // require_once './app/views/home/home.php';
    }

    public function AddUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $model = $this->loadModel('userModel');
            $result = $model->AddUser($_POST["username"], $_POST["password"], $_POST["email"], (int)$_POST["role"]);
            if ($result) {
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Cadastro bem-sucedido!'];
                header('Location: /mvc/home');
            } else {
                $_SESSION['toast'] = ['type' => 'error', 'message' => 'Aconteceu algum erro'];
                header('Location: /mvc/addUser');
            }
        } else {
            $this->renderView("home/addUser");
        }
    }

    public function EditUser($id)
    {   
        $model = $this->loadModel('userModel');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $result = $model->UpdateUser($id,$_POST["username"],$_POST["password"],$_POST["email"],$_POST["role"]);
            if($result){
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Editado bem-sucedido!'];
                header('Location: /mvc/home');
            }else{
                $_SESSION['toast'] = ['type' => 'error', 'message' => 'Algo deu errado'];
                header('Location: /mvc/edit/'.$id);
            }
        }else{
            $user = $model->getUserById($id);
            if ($user) {
                $this->renderView('home/editUser', ["user" => $user]);
            }
        }
    }
}
