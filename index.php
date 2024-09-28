<?php

declare(strict_types=1);

$routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'DELETE' => [],
];

// Add a route for a specific HTTP method
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

// Match the request URL and method, then handle it
function dispatch(string $url, string $method): void
{
    global $routes;

    if (!isset($routes[$method])) {
        http_response_code(405); // Method Not Allowed
        echo "Method $method Not Allowed";
        return;
    }

    foreach ($routes[$method] as $path => $handler) {
        if (preg_match("#^$path$#", $url, $matches)) {
            array_shift($matches); // Remove full match
            call_user_func_array($handler, $matches);
            return;
        }
    }
    
    http_response_code(404);
    handleNotFound();
}

// Default 404 handler
function handleNotFound(): void
{
    echo "404 Not Found";
}

// Register all routes and handle the current request
function listen(): void
{
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    // Define routes
    get('/', 'home');
    get('/tag/([\w-]+)', 'handleTag');
    post('/submit', 'submitForm');
    put('/update/([\w-]+)', 'updateData');
    delete('/delete/([\w-]+)', 'deleteData');

    // Dispatch the request
    dispatch($url, $method);
}

// Example handlers
function home(): void
{
    echo "Welcome to the Home Page!";
}

function handleTag(string $tag): void
{
    echo "You are viewing the tag: $tag";
}

function submitForm(): void
{
    echo "Form submitted!";
}

function updateData(string $id): void
{
    echo "Data with ID $id has been updated!";
}

function deleteData(string $id): void
{
    echo "Data with ID $id has been deleted!";
}

// Start listening for incoming requests
listen();
