<?php

class UserController extends BaseController
{

    public function GerenciarUsuarioPage()
{
    $model = $this->loadModel('userModel');

    $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $porPagina = 5; // quantidade de registros por página
    $offset = ($pagina - 1) * $porPagina;

    $total = $model->CountUsers(); // novo método no model
    $usuarios = $model->GetUsersPaginated($porPagina, $offset); // novo método no model

    $totalPaginas = ceil($total / $porPagina);

    $this->renderView("user/gerenciarUsuario", [
        "usuarios" => $usuarios,
        "paginaAtual" => $pagina,
        "totalPaginas" => $totalPaginas
    ]);
}

    public  function AddPage()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $model = $this->loadModel('userModel');
            $result = $model->AddUser($_POST["username"], $_POST["password"], $_POST["email"], (int)$_POST["role"]);
            if ($result) {
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Cadastro bem-sucedido!'];
                header('Location:'. BASE_URL."home");
            } else {
                $_SESSION['toast'] = ['type' => 'error', 'message' => 'Aconteceu algum erro'];
                header('Location:'. BASE_URL."addUser");
            }
        } else {
            $this->renderView("home/addUser");
        }
    }

    public function EditPage($id)
    {   
        $model = $this->loadModel('userModel');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $result = $model->UpdateUser($id,$_POST["username"],$_POST["password"],$_POST["email"],$_POST["role"]);
            if($result){
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Editado bem-sucedido!'];
                header('Location:'. BASE_URL."home");
            }else{
                $_SESSION['toast'] = ['type' => 'error', 'message' => 'Algo deu errado'];
                header('Location:'. BASE_URL."/edit/".$id);
            }
        }else{
            $user = $model->getUserById($id);
            if ($user) {
                $this->renderView('home/editUser', ["user" => $user]);
            }
        }
    }
}