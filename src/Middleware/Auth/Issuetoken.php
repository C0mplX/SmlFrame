<?php
/**
* Sub class of Auth that issues a token
* This class does not call the contructor function inside Auth, and
* therefor ommits the decode method.
*/

namespace Sml;

use \Firebase\JWT\JWT;

class Issuetoken extends Sml {

  # Holds all the token data.
  private $token;

  # The token secret, must be set in .env
  private $secret;

  # Issuer url default the values from the env file or localhost if not set in env
  public $iss;

  # Audiens url default the values from the env file or localhost if not set in env
  public $aud;

  # Issued at default to time(), overide by accessing obj prop.
  public $iat;

  # Not before default to time(), overide by accessing obj prop.
  public $nbf;

  # This is the token body
  public $body;

  # Experation date isset to one month default. overide by accessing obj prop.
  public $exp;

  public function __construct() {

    $this->secret = $this->_tokensecert;
    $this->iss    = $this->tokeniss;
    $this->aud    = $this->tokenaud;
    $this->iat    = time();
    $this->nbf    = time();
    $this->exp    = time() * ( 30 * 24 * 60 * 60 );

  }

  public function issue() {
  /**
  * Issue a new token based on the env varibales of the user.
  */

    $this->token = array(
       "iss"     => $this->iss,
       "aud"     => $this->aud,
       "iat"     => $this->iat,
       "nbf"     => $this->nbf,
       "body"    => $this->body,
       "exp"     => $this->exp
    );

    # returns the issued token
    return JWT::encode( $this->token, $this->secret );

  }

}
