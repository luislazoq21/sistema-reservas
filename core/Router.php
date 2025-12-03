<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function __construct() {}

    private function addRoute(
        string $method,
        string $uri,
        array $handler,
        array $middlewares = [],
    ) {
        $method = strtoupper($method);
        $uri = rtrim($uri, '/') ?: '/';

        // Convertir {param} en regex (por ejemplo: /users/{id} → /users/([^/]+))
        $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[$method][] = [
            'uri' => $uri,
            'pattern' => $pattern,
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
    }

    public function get($uri, array $handler)
    {
        $this->addRoute('GET', $uri, $handler);
    }

    public function post($uri, $handler)
    {
        $this->addRoute('POST', $uri, $handler);
    }

    public function put($uri, $handler)
    {
        $this->addRoute('PUT', $uri, $handler);
    }

    public function delete($uri, $handler)
    {
        $this->addRoute('DELETE', $uri, $handler);
    }

    public function dispatch(Request $request)
    {
        $method = $request->getMethod();
        $uri = $request->getUri();
        
        if (empty($this->routes[$method])) {
            return $this->notFound();
        }

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);
                $handler = $route['handler'];

                if (!is_array($handler) || count($handler) !== 2) {
                    // TODO: ERROR -> INVALID ROUTE HANDLER (500)
                    echo 'INVALID ROUTE HANDLER (500)';
                    return;
                }

                [$controller, $methodName] = $handler;
                if (!class_exists($controller)) {
                    // TODO: ERROR -> CONTROLLER $controller NOT FOUND (500)
                    echo "CONTROLLER $controller NOT FOUND (500)";
                    return;
                }

                $controllerInstance = new $controller();
                if (!method_exists($controllerInstance, $methodName)) {
                    // TODO: ERROR -> METHOD $methodName NOT FOUND (500)
                    echo "METHOD $methodName NOT FOUND (500)";
                    return;
                }

                $args = array_merge($matches, [$request->getBody()]);

                $responseContent = $controllerInstance->$methodName(...$args);

                echo $responseContent;
                return;
            }
        }

        return $this->notFound();        
    }

    public function notFound()
    {
        echo 'not found';
    }
}
