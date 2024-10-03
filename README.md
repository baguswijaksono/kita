# SPMF
<img align="right" width="159px" src="https://c.tenor.com/raV3qC9iOWsAAAAd/tenor.gif">

This code implements a basic routing system in PHP, using procedural programming. It registers routes for different HTTP methods and handles requests accordingly. 

**SPMF's key features are:**

- Fast
- Unopinionated
- Easy to install and set up
  
## Table of Contents
- [Route Definitions](#route-definitions)
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
