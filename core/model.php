<?php namespace core;

abstract class Model
{
	/**
	 * Get's a database connection
	 * 
	 * @param array $path Path to the config.json file
	 * @return PDO A connection to the database
	 */
	protected static function get_db_conection(string $path='config.json'): \PDO
	{
		static $conn = null;

		if($conn !== null){
			return $conn;
		}

		try {
			if(!$enconded_config = file_get_contents(dirname(__DIR__).'\core\\'.$path)){
				throw new \Exception('Could not open file');
			}
			$config = json_decode($enconded_config, true);
		} catch (\Exception $e) {
			echo 'Could not read file: '.$path;
		}
		$dsn = $config['db']['driver'].':dbname='.$config['db']['schema'].';host'.$config['db']['host'];

		try {
			return new \PDO($dsn, $config['db']['username'], $config['db']['password']);
		} catch (\PDOException $e) {
			echo "Could not connect to database".$e->getMessage();
		}
	}
}
