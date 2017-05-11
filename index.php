<?php
require_once 'vendor/autoload.php';
require 'classes/testmid.php';

$app = new Sml\Sml();

$app::get('/', function() {

  # call a middleware
  $auth = new Sml\Auth();
  $tokenData = $auth->decode();

});

$app::get('home', function() {
  echo 'home';
});

$app::get('blog/test/(\w+)', function($id) {
  print $id;
});

$app::post( '/home', function() use( $app ) {
  $r = $app->request()->json();
  $app->response( 200, $r )->sendJson();

} );

$app::put( '/home', function() use( $app ) {
  $r = $app->request()->json();
  $app->response( 200, "test" )->send();
} );

$app::delete( '/home/(\w+)', function($id) use( $app ) {
  $app->response( 200, $id )->sendJson();
} );

## test route for issuing a JWT token
$app::post( '/login', function() use( $app ) {

  # Issue a new token
  $auth = new Sml\Issuetoken();
  # Set body
  $auth->body = array( "id" => 1 );

  $token = $auth->issue(); // You can pass inn whats going in the body inside issue
  var_dump( $token );

} );

# Run the application
$app->run();
