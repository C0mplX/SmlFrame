# SmlFrame

## Getting started
run composer install
edit the .htaccess file to match your file structure

### Basic setup
```php
require_once 'vendor/autoload.php';
require 'classes/index/index.php';

$app = new Sml\Sml();

$app->get( "/", "Index");


$app->get( '/home', function() {
    echo 'home';
} );

$app->get( '/about', function() {
    echo 'about';
} );

# Run the application
$app->run();
```

### Changelog
version 0.0.1
 -  Included simple get Route support.

## To do
 - Implemnt GET route params
 - Implement POST routes
 - Implement PUT routes
 - Implement DELETE routes
