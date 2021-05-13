<?php namespace Core;

abstract class Controller
{
	// ? Don't really need this right now
	/* protected $params_route = []; // Found route parameters

	public function __construct(array $params_route) {
		$this->params_route = $params_route;
	} */

	/**
	 * Used in inherets classes to call a unknown method
	 * Also used to execute before and after filter methods
	 * All methods need to be named with the "_action" suffix to work
	 * @param string $name Method name
	 * @param array $arg Args to wich call the method
	 * @return void
	 */
	public function __call(string $name, array $args): void
	{
		$method = $name.'_action';

		if(!method_exists($this, $method)){
			throw new \Exception('Method '.$method.' was not found in controller '.get_class($this).'!');
		}
		
		// It must be === false cause it returns none or a bool
		// If you compare only using if before it will aways go
		if($this->before() === false){
			return;
		}

		call_user_func_array([$this, $method], $args);
		$this->after();
	}

	/**
	 * Before filter, called before the action method
	 * 
	 */
	protected function before(): void { }

	protected function after(): void { }

	protected function require_login()
	{
		if(!\App\Auth::get_user()){
			\App\Auth::set_return_page();
			\App\Flash::add_message("Please login before accessing the page", \App\Flash::INFO);
			\App\redirect('/login');
		}
	}

}
