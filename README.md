# KITA
<img align="right" width="159px" src="https://github.com/user-attachments/assets/3cc357f1-0856-4d32-a5a9-d8652e0e335b">

A minimal PHP microframework for handling HTTP routing in a straightforward, procedural approach, similar to a C program.

**KITA's key features are:**
- Lightweight, fast, and minimalistic
- Simplified control flow with minimal abstraction
- Extremely flexible and unopinionated
- Easy to install and set up (just a single file)
```php
<?php
require_once 'kita.php';

function main(): void
{
    get('/', 'home');
}

function home(): void
{
    echo "Hello, World!";
}
```
