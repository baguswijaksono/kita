# SPMF

This code implements a basic routing system in PHP, using procedural programming. It registers routes for different HTTP methods and handles requests accordingly. 

## Table of Contents
- [Route Definitions](#route-definitions)
- [Request Dispatching](#request-dispatching)
- [Example Handlers](#example-handlers)
- [How to Use](#how-to-use)

## Route Definitions

### Global Routes Variable
```php
$routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'DELETE' => [],
];
```
This `$routes` variable stores routes for different HTTP methods (GET, POST, PUT, DELETE) in arrays.

### Functions to Add Routes
- `get(string $path, callable $handler): void`: Adds a route for the GET method.
- `post(string $path, callable $handler): void`: Adds a route for the POST method.
- `put(string $path, callable $handler): void`: Adds a route for the PUT method.
- `delete(string $path, callable $handler): void`: Adds a route for the DELETE method.

Example:
```php
get('/example', 'exampleHandler');
```

### Route Registration Code
```php
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
```

## Request Dispatching

### `dispatch(string $url, string $method): void`

This function checks if a route matches the current URL and HTTP method. If a match is found, it calls the respective handler function. Otherwise, it returns a 404 or 405 error.

Example:
```php
dispatch('/example', 'GET');
```

```php
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
```

### 404 Handler
A custom handler to display a "Not Found" message if no route matches.
```php
function handleNotFound(): void
{
    echo "404 Not Found";
}
```

## Example Handlers

These are example route handler functions that respond to requests.

```php
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
```

## How to Use

1. Register all routes by defining them in the `listen()` function.
2. The `dispatch()` function will automatically match the incoming request with the correct route.
3. If a route matches, the handler is executed. If not, a 404 or 405 response is returned.

```php
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
```

Finally, call `listen()` to start the routing system.

```php
listen();
```
