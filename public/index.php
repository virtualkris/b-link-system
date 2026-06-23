<?php

session_start();

function loadEnv($path) {
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);

        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        $_ENV[$key] = $value;
    }
}

loadEnv(__DIR__ . '/../.env');

function url($path = '') {
    $baseUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
    $path = ltrim($path, '/');
    
    return $path === '' ? $baseUrl : $baseUrl . '/' .$path;
}

function redirect($path) {
    header('Location: ' . url($path));
    exit;
}

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\Router;

$router = new Router();

require __DIR__ . '/../app/routes.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$basePath = trim('b-link-system', '/');

if (!empty($basePath)) {
    $uri = preg_replace("#^" . preg_quote($basePath) . "/?#", '', $uri);
}

if ($uri === '' || $uri === 'public' || $uri === 'public/index.php') {
    $uri = 'dashboard';
}

$uri = preg_replace("#^public/?#", '', $uri);
$uri = $uri === '' ? 'dashboard' : $uri;

$method = $_SERVER['REQUEST_METHOD'];

$router->resolve($uri, $method);