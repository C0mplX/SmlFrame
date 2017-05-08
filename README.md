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
