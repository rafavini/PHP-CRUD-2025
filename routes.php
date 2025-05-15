<?php

// require_once './app/Controllers/homeController.php';
// require_once './app/Controllers/loginController.php';

// $homeController = new HomeController();
// $loginController = new LoginController();


// $routes = [
//     '/' => [$loginController, 'index'],
//     '/home' => [$homeController, 'index'],
//     '/post/(\d+)' => [$homeController, 'post'],
// ];


// return $routes;

// $request = $_SERVER["REQUEST_URI"];
// $request = str_replace('/mvc', '', $request);


// $request = parse_url($request,PHP_URL_PATH);




// switch($request){
//     case '/':
//         $loginController->index();
//         break;
//     case '/home':
//         checkAuth(roles::funcionario);
//         $homeController->index();
//         break;

//     case '/teste/(\d+)':
//         $homeController->teste();

//     default:
//         http_response_code(404);
//         echo "pagina nao encontrada";
//         break;
// }
class Router
{
    private static $routes = [];

    public static function get($path, $callback)
    {
        self::addRoute('GET', $path, $callback);
    }

    public static function post($path, $callback)
    {
        self::addRoute('POST', $path, $callback);
    }

    private static function addRoute($method, $path, $callback)
    {
        // Transforma "/users/{id}" em regex "/users/(\w+)"
        $pattern = preg_replace('#\{[\w]+\}#', '([\w-]+)', $path);
        $pattern = "#^" . $pattern . "$#";
        self::$routes[] = [$method, $pattern, $callback];
    }

    public static function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Ajuste: remove o diretório base "/mvc" se houver
        $baseFolder = '/mvc';
        if (strpos($requestUri, $baseFolder) === 0) {
            $requestUri = substr($requestUri, strlen($baseFolder));
        }
        if ($requestUri === '') {
            $requestUri = '/';
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as [$method, $pattern, $callback]) {
            if ($requestMethod === $method && preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);
                return call_user_func_array($callback, $matches);
            }
        }

        http_response_code(404);
        echo "Página não encontrada.";
    }
}
