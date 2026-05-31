<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function resolve($uri, $method) {
        foreach ($this->routes[$method] ?? [] as $route => $controller) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);

            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                array_shift($matches);

                [$controllerClass, $action] = explode('@', $controller);
                $controllerClass = 'App\\Controllers\\' . $controllerClass;

                if (!class_exists($controllerClass)) {
                    echo "Controller {$controllerClass} not found.";
                }

                $controllerInstance = new $controllerClass();

                if (!method_exists($controllerInstance, $action)) {
                    echo "Method {$action} not found.";
                }

                return call_user_func_array([$controllerInstance, $action], $matches);
            }
        }

        http_response_code(404);
        echo '404 - Page Not Found';
    }
}