<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bookshelf!</title>
</head>
<body>
	<h1>Hello, World!</h1>
	
	<?php
		spl_autoload_register(function ($class){
			$root = dirname(__DIR__);
			$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
			if (is_readable($file)) {
				require $file;
			}
		});
		
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
	
</body>
</html>