<?php
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


echo '<pre>';
print_r( $app );
$app->run();
