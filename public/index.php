<?php

require_once dirname(__DIR__).'\vendor\autoload.php';

error_reporting(E_ALL);
set_error_handler('\Core\Error::error_handler');
set_exception_handler('\Core\Error::exception_handler');

session_start();

$router = new Core\Router();
// Main page
$router->add('',[
	'controller' => 'Home',
	'action' => 'index'
]);

$router->add('register',[
	'controller' => 'Register',
	'action' => 'new'
]);

$router->add('login',[
	'controller' => 'Access',
	'action' => 'login'
]);

$router->add('logout',[
	'controller' => 'Access',
	'action' => 'logout'
]);

$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
?>
