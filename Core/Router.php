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


            // 2. Chama o método do controlador.
            $this->callControllerAction($route['controller']);
        } else {
            // Se a rota não for encontrada.
            header("HTTP/1.0 404 Not Found");
            echo "Página não encontrada.";
        }
    }
}
