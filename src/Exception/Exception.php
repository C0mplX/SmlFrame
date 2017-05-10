<?php
namespace Sml;

class Exception {

  public function __construct( $exception ) {

    if( getenv('ENV', 'dev') == "dev" ) {
      http_response_code( 500 );
      throw new \Exception( $exception );
    } else  {
      http_response_code( 500 );
      echo "Application error 500";
    }
    die();
  }

}
