<?php

require_once dirname(__DIR__).'\vendor\autoload.php';

error_reporting(E_ALL);
set_error_handler('core\Error::error_handler');
set_exception_handler('core\Error::exception_handler');

$router = new core\Router();

// Main page
$router->add("",[
	"controller" => "Home",
	"action" => "index"
]);

$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{action}/{controller}', ['namespace' => 'admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
?>