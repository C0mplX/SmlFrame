<?php
require_once 'vendor/autoload.php';

$app = new Sml\Sml();


$app::get('/', function(){
  echo 'test';
});

$app::get('home', function(){
  echo 'home';
});

$app::get('blog/test/(\w+)', function($id){
  print $id;
});

$app::post( '/home', function() use( $app ) {
  $r = $app->request()->json();

  $app->response( 200, "test" )->send();
} );

$app::put( '/home', function() use( $app ) {
  $r = $app->request()->json();
  $app->response( 200, "test" )->send();
} );

$app::delete( '/home/(\w+)', function($id) use( $app ) {
  $app->response( 200, $id )->sendJson();
} );

# Run the application
$app->run();
