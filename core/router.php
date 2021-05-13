<?php namespace Core;

/**
 * Responsible for routing app requests
 */
class Router
{
	protected $routes = []; // List of all routes

	protected $params = []; // Parameters of the route found

	/**
	 * Gets all the routes
	 * @return array Routes
	 */
	public function get_routes(): array
	{
		return $this->routes;
	}

	/**
	 * Get all parameters
	 * @return array Params
	 */
	public function get_params(): array
	{
		return $this->params;
	}

	/**
	 * Adds route to the route list
	 *
	 * @param string $rota Route's URL
	 * @param array $params Controllers, actions, etc.
	 * 
	 * Eg: add('home', ['controller' => Home, 'action' => index])
	 * Adds a controller that redirects /home to the home class and index method
	 */
	public function add(string $route, array $params = []): void
	{
		// Ignores slash
		$route = preg_replace('/\//', '\\/', $route);
		// Converts variables, eg {controller}
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
		// Converts variables with custom variables, eg. {id:\d+}
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
		// Add delimiters of begining and end and adds case insensitiveness
		$route = '/^'.$route.'$/i';
		
		$this->routes[$route] = $params;
	}

	/**
	 * Matches a route with the params with the routing array
	 * @param string $url Route URL
	 * @return bool Was found?
	 */
	public function match(string $url): bool
	{
		foreach($this->routes as $route => $params){
			if(preg_match($route, $url, $matches)){
				foreach($matches as $key => $match){
					if(is_string($key)){
						$params[$key] = $match;
					}
				}
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	public function dispatch($url)
	{
		
		if(!$this->match($url)) {
			throw new \Exception('Route '.$url.' not found!');
			return;
		}

		$controller = $this->get_namespace().$this->to_pascal_case($this->remove_hyphens($this->params['controller']));

		if(!class_exists($controller)) {
			throw new \Exception('Controller class '.$controller.' not found!');
			return;
		}
		
		$action = $this->to_snake_case($this->remove_hyphens($this->params['action']));
		
		/*if(!is_callable([$controller_object, $action])){
			echo 'Method '.$action.' of controller '.$controller.' cannot be accessed'; // TODO: FIX THIS ERROR
			return;
		}
		$controller_object->$action();*/
		if(preg_match('/action$/i', $action) !== 0){
			throw new \Exception('Method '.$action.' of controller '.$controller.' cannot be accessed');
		}
		
		$controller_object = new $controller();
		if(isset($this->params['id'])){
			$controller_object->$action(intval($this->params['id']));
		}
		$controller_object->$action();
	}

	private function get_namespace(): string
	{
		$namespace = 'App\Controller\\';
		if(array_key_exists('namespace', $this->params)){
			$namespace .= $this->params['namespace'].'\\';
		}

		return $namespace;
	}

	/**
	 * Removes hyphes and put spaces in the place 
	 * 
	 * @param string $str String to be converted
	 * @return string Converted string
	 */
	private function remove_hyphens(string $str): string
	{
		return str_replace('-', ' ', $str);
	}

	/**
	 * Converts a string with words separeted with spaces to pascal case
	 *
	 * @param string $str String, separeted with spaces, to be converted
	 * @return string Converted string
	 */
	protected function to_pascal_case(string $str): string
	{
		return str_replace(' ', '', ucwords($str));
	}

	/**
	 * Converts a string with words separeted with spaces to snake case
	 * 
	 * @param string $str String, separeted with spaces, to be converted
	 * @return string Converted string
	 */
	protected function to_snake_case(string $str): string
	{
		return str_replace(' ', '_', strtolower($str));
	}
}