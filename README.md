# SmlFrame

## Getting started
run composer install
edit the .htaccess file to match your file structure

### Basic setup
```php
require_once 'vendor/autoload.php';

$app = new Sml\Sml();

# Run the application
$app->run();
```

### ROUTING with request
```php
require_once 'vendor/autoload.php';

$app = new Sml\Sml();

$app::get('/', function(){
  echo 'test';
});

# If you want to pass arguments to the function you do this with regEx values
# Supported values are for Strings and Ints

# String and int value

$app::get('/user/(\w+)/(\d+)', function( $string, $int ){

  # You can then use the params here

});

# Run the application
$app->run();
```

### Response
To use the response obj you need yo inject $app onto your functions
```php
require_once 'vendor/autoload.php';

$app = new Sml\Sml();

$app::get('/', function() use( $app ){
  $app->response( 200, "it Works" )->send();
});

# You can also send back json_response by cahning the sendJson method onto the response method.
$app::get('/', function() use( $app ){
  $app->response( 200, "it Works" )->sendJson();
});

$app->run();
```

### Changelog
version 0.0.2
 - Added support for POST, GET, PUT, DELETE routes
 - Added exception class for handling errors
 - Added Response obj
 - Added Request obj
 - Added the use of env file

version 0.0.1
 -  Included simple get Route support.
