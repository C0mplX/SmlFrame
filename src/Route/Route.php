<?php
namespace Sml;

class Route {

  # Holds all the get Routes
  private $_get = [];

  # Holds all the get Methods
  private $_getMethods = [];

  # Holds all the post Routes
  private $_post = [];

  # Holds all the put Routes
  private $_put = [];

  # Holds all the delete Routes
  private $_delete = [];


  public function get( $uri, $method = null ) {

    # Check if there are any params passed to the uri

    $params = explode( ':', $uri );

    if( count( $params ) > 1 ) {

      $this->_get[] = "/". trim($params[0], "/");

    } else {
      $this->_get[] = "/". trim($uri, "/");
    }

    if( $method != null ) {
      $this->_getMethods[] = $method;
    }

  }

  protected function runGet() {
  /**
   * @Method for running the Get requests
   */

      $uri_get = isset( $_GET['uri'] ) ? "/" . $_GET['uri'] : '/';

      $striped_uri_get = $this->splitURI( $uri_get );

      # Check if there are any query params inside the uri
      foreach ($this->_get as $key => $value) {

        if( $value == '/'. $striped_uri_get[0] ) {
          array_shift($striped_uri_get);
          if( is_string( $this->_getMethods[$key] ) ) {
            $class = new $this->_getMethods[$key];
            $class->_getParams = $striped_uri_get;
          }else {
            call_user_func_array( $this->_getMethods[$key], $striped_uri_get  );
          }

        }
      }
  }

  private function splitURI( $uri ) {

    return explode( '/', $uri );

  }

}
