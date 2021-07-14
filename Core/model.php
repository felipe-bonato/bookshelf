<?php namespace Core;

abstract class Model
{
	/**
	 * Get's a database connection
	 * 
	 * @param array $path Path to the config.json file
	 * @return PDO A connection to the database
	 */
	protected static function get_db_conection(string $path='../App/config.json'): \PDO
	{
		static $conn = null;

		if($conn !== null){
			return $conn;
		}
	
		if(!$enconded_config = file_get_contents(dirname(__DIR__).'\core\\'.$path)){
			throw new \Exception('Could not open file '.$path);
		}
		$config = json_decode($enconded_config, true);
		
		$dsn = $config['db']['driver'].':dbname='.$config['db']['schema'].';host'.$config['db']['host'];

		try {
			$conn = new \PDO($dsn, $config['db']['username'], $config['db']['password']);
			$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (\PDOException $e) {
			throw new \Exception("Could not connect to database ".$e->getMessage());
		}
	}
}
