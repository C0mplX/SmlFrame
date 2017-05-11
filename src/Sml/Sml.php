<?php
namespace Sml;

use Sml\Route;

class Sml extends Routes {

  # holds the environment dev or prod
  private $env;

  # Holds all the request obj
  private $_request;

  # Holds all the request headers
  private $_headers;

  # Holds all re response obj
  private $_response;

  public function __construct() {
  /**
   * Initis the Framework and loads the route class.
   */

    # Load the environment variables
    $dotenv = new \Dotenv\Dotenv( realpath( __DIR__ . '/../..' ) );
    $dotenv->load();

    # Set config variables
    $this->env = getenv('ENV', 'dev');

  }


  #########################################
  # Handle requests
  #########################################

  public function request() {
  /**
  * @method returns the request body for the HTTP request
  */

    $this->_request = file_get_contents('php://input');
    return $this;
  }

  public function headers() {
  /**
  * @method for returning the request headers
  */
    $headers = $this->_headers = getallheaders();
    return $headers;
  }

  public function body() {
  /**
  * @method returns a x-form-urlencoded post object
  * @uses $this->_request
  * @return obj
  */

    $request = $_POST;
    return $request;
  }

  public function json( $format = false ) {
  /**
  * @method returns a json encoded versjon of JSON application data subbimted by the cliend
  * @uses $this->_request
  * @return obj
  */
    $request = $this->_request;
    return json_decode( $request, $format );
  }


  #########################################
  # Handle response
  #########################################
  public function response( $status, $data ) {
  /**
  * Handles the application response
  * @param $status INT
  * @param $data ANY
  * @return $this
  */


    # Check if status is a int
    if( !is_int( $status ) ) new Exception( "Status code must be a Integer" );
    $this->_response = array( "status" => $status, "data" => $data );
    return $this;

  }


  public function sendJson() {
  /**
  * @method returns the response as json_encoeded data
  * @return _response
  */
    http_response_code( $this->_response["status"] );

    # Add the error key if response is everything but the 200 series

    if( $this->_response["status"] >= 200 && $this->_response["status"] <=299 ) {
      # Add a false error flag
      $this->_response["error"] = false;
    }else {
      # Add a trueerror flag
      $this->_response["error"] = true;
    }

    echo json_encode( $this->_response );
    die();
  }

  public function send() {
    http_response_code( $this->_response["status"] );

    # normal data must be string
    if( is_array($this->_response["data"]) ) new Exception( "Data must be a string, array given" );
    if( is_object( $this->_response["data"] ) ) new Exception( "Data must be a string, object given" );
    echo $this->_response["data"];
    die();
  }


  private function loadEnv() {
  /**
   * @method for loading the envirionment for the app
   */

    if( $this->env == 'dev' ) {
      ini_set('display_errors', 1);
    }else {
      ini_set('display_errors', 0);
    }
  }

  public function run() {
  /**
   * @method for running the framework.
   */

      # Load the environmetn
      $this->loadEnv();

      # Run the routes
      $this->execute( $_SERVER['REQUEST_URI'] );

  }

}
