<?php

class Router
{
    protected $routes = [];

    public function add($uri, $controllerPath, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controllerPath,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    public function get($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'GET');
    }

    public function post($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'POST');
    }

    public function delete($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'DELETE');
    }

    public function put($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'PUT');
    }

    public function patch($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'PATCH');
    }

    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
    }

    public function run($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                //apply middleware if present 
                Middleware::resolve($route['middleware']);
                // Separate controller class and method
                [$controller, $method] = explode('@', $route['controller']);
                // Load the controller file
                require_once base_path('app/controllers/'.$controller.'.class.php');
                // Create an instance of the controller and call the method
                $controllerInstance = new $controller();
                $controllerInstance->$method();
                return;
            }
        }
        $this->abort(); // this will be called if no route is found
    }

    public function abort( $status = '404') {
        http_response_code($status);
        require_once base_path('app/views/status.php');
        die();
      }
}
