<?php
class Route {
	private $expr;
	private $url;
	private $callback;
	private $matches;
	private $authenticate;
	private $methods = array('GET', 'POST', 'HEAD', 'PUT', 'DELETE', 'PATCH');

	/**
	 * Constructor
	 * @param string $expr regular expresion to test against
	 * @param function $callback function executed if route matches
	 * @param string|array $methods methods allowed
	 */
	public function __construct($expr, $callback, $methods = null, $authenticate = false) {
		// Allow an optional trailing backslash
		$this->authenticate = $authenticate;
		$this->url = $expr;
		$this->expr  = $this->chk('#^' . $expr . '/?$#');
		$this->callback = $callback;
		if( $methods !== null ) {
			$this->methods = is_array($methods) ? $methods : array($methods);
		}
	}

	/**
	 * See if route matches with path
	 * @param string $path
	 * @return boolean
	 */
	public function matches($path) {
		if( preg_match($this->expr, $path, $this->matches) && in_array($_SERVER['REQUEST_METHOD'], $this->methods) ) {
			return true;
		}
		return false;
	}

	public function getParams(){
		return $this->matches;
	} 

	public function expr(){
		return $this->url;
	}

	public function method(){
		if(count($this->methods)>1){
			return 'ALL';
		}else{
			return $this->methods[0];
		}

	}

	public function controller(){
		return explode('#', $this->callback);
	}

	public function verify(){
		return $this->authenticate;
	}


	/**
	 * Replace :id and :string with expresions regulars
	 * @param string $path
	 */
	private function chk($expr){
		$expr = str_replace(':id', '([0-9]+)', $expr);
		$expr = str_replace(':str', '([a-zA-Z-]+)', $expr);
		return $expr;
	}
}
