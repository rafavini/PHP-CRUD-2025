<?php


class Router
{
    protected $routes = [];
    public function get($uri, $controller, $roles = [])
    {
        $this->addRoute('GET', $uri, $controller, $roles);
    }
    public function post($uri, $controller, $roles = [])
    {
        $this->addRoute('POST', $uri, $controller, $roles);
    }
    public function delete($uri, $controller, $roles = [])
    {
        $this->addRoute('DELETE', $uri, $controller, $roles);
    }
    public function put($uri, $controller, $roles = [])
    {
        $this->addRoute('PUT', $uri, $controller, $roles);
    }


    public function addRoute($method, $uri, $controller, $roles = [])
    {
        $this->routes[$method][$uri] = ['controller' => $controller, 'roles' => $roles];
        // print_r($this->routes);
    }

    protected function checkRoles(array $allowedRoles)
    {
        if (empty($allowedRoles)) return true;

        if (!isset($_SESSION['userAuth']['role'])) return false;
    
        $userRole = $_SESSION['userAuth']['role'];
        return in_array($userRole, $allowedRoles); // aqui vai achar 'admin'
    }

    protected function callControllerAction($controllerAction)
    {
        // Divide "Controller:method"
        list($controllerName, $methodName) = explode(':', $controllerAction);

        // Evita path traversal
        $controllerName = basename($controllerName);

        // Define o caminho do arquivo
        if (isset($_GET['url']) && str_starts_with($_GET['url'], 'api/')) {
            $controllerPath = __DIR__ . '/../controllers/api/' . $controllerName . '.php';
        } else {
            $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';
        }

        // Verifica se o arquivo existe
        if (!file_exists($controllerPath)) {
            http_response_code(404);
            echo "Erro: O arquivo do controlador '$controllerPath' não foi encontrado.";
            return;
        }

        // Inclui o arquivo
        require_once $controllerPath;

        // Verifica se a classe existe
        if (!class_exists($controllerName)) {
            http_response_code(500);
            echo "Erro: A classe '$controllerName' não foi encontrada no arquivo.";
            return;
        }

        // Instancia a classe
        $controller = new $controllerName();

        // Verifica se o método existe
        if (!method_exists($controller, $methodName)) {
            http_response_code(404);
            echo "Erro: O método '$methodName' não foi encontrado no controlador '$controllerName'.";
            return;
        }

        // Chama o método
        $controller->$methodName();
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = "/" . strtok($_GET['url'], '?');

        // Verifica se a URI está presente na sua rota.
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            // print_r($route);
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
