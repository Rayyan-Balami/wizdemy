<?php

/**
 * Router class
 * 
 * This class contains methods for adding routes and executing the appropriate controller method for a given URI and HTTP method.
 * 
 * methods: get, post, delete, put, patch, only, run, abort
 */
class Router
{
    protected $routes = [];

    protected function add($uri, $controllerPath, $method)
    {
        // /test/{id}
        $uri = preg_replace('/{([a-zA-Z0-9-_]+)}/', '(?P<\1>[a-zA-Z0-9-_]+)', $uri);
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controllerPath,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    /**
     * The get method is used to add a route for the GET HTTP method.
     * 
     * @param string $uri The URI to match against the routes.
     * @param string $controllerPath The path to the controller file and method to execute.
     */
    public function get($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'GET');
    }

    /**
     * The post method is used to add a route for the POST HTTP method.
     * 
     * @param string $uri The URI to match against the routes.
     * @param string $controllerPath The path to the controller file and method to execute.
     */
    public function post($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'POST');
    }

    /**
     * The delete method is used to add a route for the DELETE HTTP method.
     * 
     * @param string $uri The URI to match against the routes.
     * @param string $controllerPath The path to the controller file and method to execute.
     */
    public function delete($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'DELETE');
    }

    /**
     * The put method is used to add a route for the PUT HTTP method.
     * 
     * @param string $uri The URI to match against the routes.
     * @param string $controllerPath The path to the controller file and method to execute.
     */
    public function put($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'PUT');
    }

    /**
     * The patch method is used to add a route for the PATCH HTTP method.
     * 
     * @param string $uri The URI to match against the routes.
     * @param string $controllerPath The path to the controller file and method to execute.
     */
    public function patch($uri, $controllerPath)
    {
        return $this->add($uri, $controllerPath, 'PATCH');
    }

    /**
     * The only method is used to apply middleware to a specific route.
     * 
     * @param string $middleware The middleware to apply to the route.
     */
    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
    }

    /**
     * The run method is responsible for executing the appropriate controller method for a given URI and HTTP method.
     * It iterates over the routes stored in the Router, and if it finds a match, it applies any associated middleware,
     * separates the controller class and method, loads the controller file, creates an instance of the controller, 
     * and calls the appropriate method.
     * If no route is found, it calls the abort method, which sends a 404 HTTP response.
     *
     * @param string $uri The URI to match against the routes.
     * @param string $method The HTTP method to match against the routes.
     */
    public function run($uri, $method)
    {
        foreach ($this->routes as $route) {
            if (preg_match("#^{$route['uri']}$#", $uri, $matches) && $route['method'] === strtoupper($method)) {
                //apply middleware if present 
                Middleware::resolve($route['middleware']);
                // Separate controller class and method
                [$controller, $method] = explode('@', $route['controller']);
                // Load the controller file
                require_once base_path('app/controllers/' . $controller . '.php');
                // Create an instance of the controller and call the method
                $controllerInstance = new $controller();
                // remove first element from matches array
                array_shift($matches);
                // remove numeric keys from matches array
                $matches = array_filter($matches, function ($key) {
                    return is_string($key);
                }, ARRAY_FILTER_USE_KEY);
                // select those keys that are strings and pass them as arguments to the method
                $controllerInstance->$method(...array_values($matches));
                return;
            }
        }
        abort(); // this will be called if no route is found
    }

}
