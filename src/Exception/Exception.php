<?php
namespace Sml;

class Exception extends Sml{

  public function __construct( $exception ) {

    if( $this->_env == "dev" ) {
      http_response_code( 500 );
      throw new \Exception( $exception );
    } else  {
      http_response_code( 500 );
      echo "Application error 500";
    }
    die();
  }

}
