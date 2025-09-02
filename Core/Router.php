<?php

namespace Core;

class Router
{
    protected $routes = [];
    public function get($uri, $controller, $roles = [])
    {
        $this->addRoute('GET', $uri, $controller, $roles);
        // echo "GET method called for URI: $uri, Controller: $controller";
    }
    public function post($uri, $controller, $roles = []) {
        $this->addRoute('POST', $uri, $controller, $roles);
    }
    public function delete($uri, $controller, $roles = []) {
        $this->addRoute('DELETE', $uri, $controller, $roles);
    }
    public function put($uri, $controller, $roles = []) {
        $this->addRoute('PUT', $uri, $controller, $roles);
    }


    public function addRoute($method, $uri, $controller, $roles = [])
    {
        $this->routes[$method][$uri] = ['controller' => $controller, 'roles' => $roles];
    }

    protected function checkRoles(array $allowedRoles)
    {
        // Se a rota não exige roles, o acesso é permitido.
        if (empty($allowedRoles)) {
            return true;
        }

        // Em um projeto real, você obteria a role do usuário logado.
        // Este é um exemplo de simulação.
        $userRole = 'user'; // Substitua por sua lógica de autenticação.

        return in_array($userRole, $allowedRoles);
    }

    protected function callControllerAction($controllerAction)
    {
        list($controllerName, $methodName) = explode(':', $controllerAction);

        // Use o namespace "Controllers" que você configurou
        $fullControllerName = 'Controllers\\' . $controllerName;

        if (!class_exists($fullControllerName)) {
            echo "Erro: O controlador '$fullControllerName' não foi encontrado.";
            return;
        }

        $controller = new $fullControllerName();

        // Verifica se o método existe no controlador.
        if (!method_exists($controller, $methodName)) {
            echo "Erro: O método '$methodName' não foi encontrado no controlador '$controllerName'.";
            return;
        }

        // Finalmente, chama o método do controlador.
        $controller->$methodName();
    }
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = "/" . strtok($_GET['url'], '?');
        // print_r($this->routes);

        // if (empty($uri)) {
        //     $uri = '/';
        // }

        // Verifica se a URI está presente na sua rota.
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];

            // 1. Verificação de permissões (roles).
            if (!$this->checkRoles($route['roles'])) {
                header("HTTP/1.0 403 Forbidden");
                echo "Acesso negado: Você não tem permissão para acessar esta página.";
                return;
            }

            // 2. Chama o método do controlador.
            $this->callControllerAction($route['controller']);
        } else {
            // Se a rota não for encontrada.
            header("HTTP/1.0 404 Not Found");
            echo "Página não encontrada.";
        }
    }
}
