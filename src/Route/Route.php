<?php
namespace Sml;

class Routes {

  private static $routes = array();

	private function __construct() {}
	private function __clone() {}


  /**
  * Register the get routes
  */
	public static function get($pattern, $callback) {

    if( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
      $pattern = '/' . str_replace('/', '\/', $pattern) . '$/';
      self::$routes[$pattern] = $callback;
    }

    # Init a new instance of the Routes class so we can implement a middleware
    $inst = new Routes;
    return $inst;

	}

  /**
  * Register the POST routes
  */
  public static function post($pattern, $callback) {

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
  		$pattern = '/' . str_replace('/', '\/', $pattern) . '$/';
  		self::$routes[$pattern] = $callback;
    }

    # Init a new instance of the Routes class so we can implement a middleware
    $inst = new Routes;
    return $inst;

	}

  /**
  * Register the put routes
  */
  public static function put($pattern, $callback) {

    if( $_SERVER['REQUEST_METHOD'] === 'PUT' ) {
  		$pattern = '/' . str_replace('/', '\/', $pattern) . '$/';
  		self::$routes[$pattern] = $callback;
    }

    # Init a new instance of the Routes class so we can implement a middleware
    $inst = new Routes;
    return $inst;

	}

  /**
  * Register the delete routes
  */
  public static function delete($pattern, $callback) {

    if( $_SERVER['REQUEST_METHOD'] === 'DELETE' ) {
  		$pattern = '/' . str_replace('/', '\/', $pattern) . '$/';
  		self::$routes[$pattern] = $callback;
    }

    # Init a new instance of the Routes class so we can implement a middleware
    $inst = new Routes;
    return $inst;
	}


  /**
  * Execute the routes
  */
	public function execute($url) {

		foreach (self::$routes as $pattern => $callback) {
			if (preg_match($pattern, $url, $params)) {
				array_shift($params);
				return call_user_func_array($callback, array_values($params));
			}
		}

	}


}
