# KITA
<img align="right" width="159px" src="https://github.com/user-attachments/assets/6ddb199b-bb33-4d29-9e92-11ebcfc315c7">

Kitaphp is a minimal PHP microframework designed for handling HTTP routing in a way that may appeal to low-level programming enthusiasts or embedded developers due to its procedural, straightforward approach. Like a C program

**KITA's key features are:**

- Fast
- Unopinionated
- Easy to install and set up

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
