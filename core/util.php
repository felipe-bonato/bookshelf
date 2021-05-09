<?php namespace core;

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
	if(!$enconded_config = file_get_contents(dirname(__DIR__).'\core\config.json')){
		throw new \Exception('Could not open file');
	}
	return json_decode($enconded_config, true);
}
