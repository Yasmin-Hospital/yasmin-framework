# Yasmin Framework

## Installation

```
composer require yasmin/framework
```

## Create .htaccess file

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php
```

## Create index.php file

```php
<?php 

require 'vendor/autoload.php';

class HomeController {

    function index() {
        return '<h1>Hello World</h1>';
    }

}

Yasmin\Uri::setBaseUrl('<your-app-base-url>');
Yasmin\Route::bind('/', 'HomeController@index');
Yasmin\Framework::run();
```