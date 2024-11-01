# KITA
<img align="right" width="159px" src="https://github.com/user-attachments/assets/3cc357f1-0856-4d32-a5a9-d8652e0e335b">

A minimal PHP microframework for handling HTTP routing in a straightforward, procedural approach, similar to a C program.

**KITA's key features are:**
- Lightweight, Fast and unbloated
- Easy control flow
- Extremely unopinionated
- Easy to install and set up (consists of just a single file)

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
