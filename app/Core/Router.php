<?php

namespace App\Core;

//exemplo de chamada de rota
/*get('/home', function() { 
    echo 'Rota GET HOME';
    });
*/

class Router
{
    private $routes = [];
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    public function put($path, $callback)
    {
        $this->addRoute('PUT', $path, $callback);
    }

    public function delete($path, $callback)
    {
        $this->addRoute('DELETE', $path, $callback);
    }

    private function addRoute($method, $path, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function regexIDPath($path)
    {
        return preg_replace('/\{(\w+)\}/', '([^/]+)', $path);
    }

    public function resolve()
    {

        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pattern = $this->regexIDPath($route['path']);

            if ($route['method'] === $requestMethod && preg_match("#^$pattern$#", $requestUri, $matches)) {
                array_shift($matches);
                return call_user_func_array($route['callback'], $matches);
            }
        }

        http_response_code(404);
        $this->view->render('errors/404.twig.php');
        return null;
    }
}
