<?php namespace App;

function conlog($messege) {
	echo '<script>console.log("'.$messege.'");</script>';
}

/**
 * Load configuration file
 * 
 * @return array Configurations
 */
function load_config(): array
{
	if(!$enconded_config = file_get_contents(dirname(__DIR__).'\App\config.json')){
		throw new \Exception('Could not open file');
	}
	return json_decode($enconded_config, true);
}

function redirect(string $url): void
{
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$url, true, 303);
}

function put($var): void
{
	if(is_string($var)){
		echo($var);
	} else {
		var_dump($var);
	}
}
