<?php

declare(strict_types=1);

$routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'DELETE' => [],
];

function get(string $path, callable $handler): void
{
    global $routes;
    $routes['GET'][$path] = $handler;
}

function post(string $path, callable $handler): void
{
    global $routes;
    $routes['POST'][$path] = $handler;
}

function put(string $path, callable $handler): void
{
    global $routes;
    $routes['PUT'][$path] = $handler;
}

function delete(string $path, callable $handler): void
{
    global $routes;
    $routes['DELETE'][$path] = $handler;
}

function dispatch(string $url, string $method): void
{
    global $routes;

    if (!isset($routes[$method])) {
        http_response_code(405);
        echo "Method $method Not Allowed";
        return;
    }

    foreach ($routes[$method] as $path => $handler) {
        if (preg_match("#^$path$#", $url, $matches)) {
            array_shift($matches);
            call_user_func_array($handler, $matches);
            return;
        }
    }

    http_response_code(404);
    handleNotFound();
}

function handleNotFound(): void
{
    echo "404 Not Found";
}

main();
dispatch(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $_SERVER['REQUEST_METHOD']);
