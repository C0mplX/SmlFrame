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
    $this->_get[] = "/". trim($uri, "/");

    if( $method != null ) {
      $this->_getMethods[] = $method;
    }
  }

  protected function runGet() {
  /**
   * @Method for running the Get requests
   */

      $uri_get = isset( $_GET['uri'] ) ? "/". $_GET['uri']: '/';
      var_dump( $uri_get );
      # Check if there are any query params inside the uri

      foreach ($this->_get as $key => $value) {

        if( $value == $uri_get ) {

          if( is_string( $this->_getMethods[$key] ) ) {
            new $this->_getMethods[$key];
          }else {
            call_user_func( $this->_getMethods[$key] );
          }

        }
      }
  }

}
