<?php
/**
* SmlFrame ships with a Auth middleware using JWT tokens
* Feel free to extend this class and implement your own auth middleware
* This auth class is only designed to work with a Json body response.
* @uses Firebase\JWT\JWT
*/
namespace Sml;
use \Firebase\JWT\JWT;

class Auth extends Sml {

  private $secret;

  public function __construct() {

    # On every route request we check if there is a token present in the
    # Request header.

    $this->secret = getenv( "TOKENSECRET");
  }

  public function decode() {
  /**
  * @method for decoding the JWT token sendt in the Auth header
  * @uses Sml->request()->headers()
  * @uses Sml->response()->json()
  * @return JWT payload | Json response
  */

    $headers      = $this->request()->headers();

    # Check to see if there is a auth header


    if( !isset($headers['Authorization'] ) ) {
      $this->response( 401, "no access" )->sendJson ();
    }


    $authheader   = @$headers['Authorization'];
    # Try to decode the token
    try {

      # Strip the "Basic" from the Authorization header
      $token = substr( $authheader, strpos( $authheader, " " ) + 1 );

      # Try to decode the token
      $decode = JWT::decode( $token, $this->secret, array( "HS256" )  );

      return $decode;

    } catch ( \Exception $e) {

      # Return a 401
      $this->response( 401, "no access" )->sendJson();

    }

  }

}
