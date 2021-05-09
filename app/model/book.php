<?php namespace App\Model;

class Book extends \Core\Model
{
	public static function get_all(): array
	{
		try {
			$conn = static::get_db_conection();
			
			if(!$stmt = $conn->prepare("SELECT `id`, `name`, `author`, `owner`, `cover_image`, `price` FROM books;")){
				throw new \Exception("Could not prepare fetch book name by book id statement");
			}
			
			if(!$stmt->execute()){
				throw new \Exception("Could not execute database query");
			}
			
			if($res = $stmt->fetchAll(\PDO::FETCH_ASSOC)){ //TODO: THIS MIGHT NEED TO CHANGE
				return $res;
			}
		} catch (\PDOException $e) {
			echo 'DB connection error: '.$e->getMessage();
		}
	}
}
