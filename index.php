<?php
require_once 'vendor/autoload.php';
require 'classes/index.php';

$app = new Sml\Sml();

$app->get( "/", 'Index' );


$app->get( '/home/:name', function($name) {
    echo $name . '</br>';
} );

$app->get( '/about', function() {
    echo 'about';
} );

//echo '<pre>';
//print_r( $app );

# Run the application
$app->run();
