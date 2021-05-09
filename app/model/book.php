<?php namespace App\Model;

class Book extends \Core\Model
{
	public static function get_all(): array
	{
		try {
			$conn = static::get_db_conection();
			
			if(!$stmt = $conn->prepare("SELECT book.id AS id, book.name AS name, author.name AS author, user.nickname AS owner, book.cover_image AS cover_image, book.price AS price FROM book INNER JOIN user ON book.id_owner = user.id LEFT JOIN author ON book.id_author = author.id;")){
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
