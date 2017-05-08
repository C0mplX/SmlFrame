<?php
namespace Sml;

use Sml\Route;

class Sml extends Route {

  public $env;

  public function __construct() {
  /**
   * Initis the Framework and loads the route class.
   */

    $this->env = 'dev';

  }

  public function run() {
  /**
   * @method for running the framework.
   */

      # Load the environmetn
      $this->loadEnv();
      $this->runGet();

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

}
