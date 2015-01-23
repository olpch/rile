<?php 
class Router {
	// Variables
	private $base_path;
	private $path;
	public $routes = array();

	/**
	 * Constructor
	 * @param string $base_path the index url
	 */
	public function __construct($base_path = '/') {
		$this->base_path = $base_path;
 		$path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$path = substr($path, strlen($base_path));
		// echo $path;
		// die();
		$this->path = $path;
	}

	/**
	 * Add a route
	 * @param string $expr
	 * @param function $callback
	 * @param array|string $methods
	 */
	public function all($expr, $callback, $methods = null, $authenticate = false) {
		$this->routes[] = new Route($expr, $callback, $methods, $authenticate);
	}

	/**
	 * Alias for all
	 */
	public function add($expr, $callback, $methods = null, $authenticate = false) {
		return $this->all($expr, $callback, $methods, $authenticate);
	}

	/**
	 * Add a route for GET requests
	 * @param string $expr
	 * @param function $callback
	 */
	public function get($expr, $callback, $authenticate = false) {
		$this->routes[] = new Route($expr, $callback, 'GET', $authenticate);
	}

	/**
	 * Add a route for POST requests
	 * @param string $expr
	 * @param function $callback
	 */
	public function post($expr, $callback, $authenticate = false) {
		$this->routes[] = new Route($expr, $callback, 'POST', $authenticate);
	}

	/**
	 * Add a route for HEAD requests
	 * @param string $expr
	 * @param function $callback
	 */
	public function head($expr, $callback, $authenticate = false) {
		$this->routes[] = new Route($expr, $callback, 'HEAD', $authenticate);
	}

	/**
	 * Add a route for PUT requests
	 * @param string $expr
	 * @param function $callback
	 */
	public function put($expr, $callback, $authenticate = false) {
		$this->routes[] = new Route($expr, $callback, 'PUT', $authenticate);
	}

	/**
	 * Add a route for DELETE requests
	 * @param string $expr
	 * @param function $callback
	 */
	public function delete($expr, $callback, $authenticate = false) {
		$this->routes[] = new Route($expr, $callback, 'DELETE', $authenticate);
	}

	/**
	 * Test all routes until any of them matches
	 */
	public function run() {
		foreach ($this->routes as $route) {
			if( $route->matches($this->path) ) {
				return $route;
			}
		}
		return null;
		//throw new \Exception("No routes matching {$this->path}");
		
	}

	public function rlist() {
		return $this->routes;
	}

	/**
	 * Get the current url or the url to a path
	 * @param string $path
	 */
	public function url($path = null) {
		if( $path === null ) {
			$path = $this->path;
		}
		return $this->base_path . $path;
	}

}