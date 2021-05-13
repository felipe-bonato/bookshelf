<?php namespace App\Model;

class Book extends \Core\Model
{
	public function __construct(array $data=[])
	{
		foreach($data as $key => $value){
			$this->$key = $value;
		}
	}

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

	public function insert(): bool
	{
		$this->id_owner = $_SESSION['user_id'];
		//$this->validate_register_data();

		if(!empty($this->errors)){
			return false;
		}

		$conn = static::get_db_conection();

		

		if(!$stmt = $conn->prepare(
				'INSERT INTO book
				(id, id_owner, id_buyer, id_author, id_genre, name, isbn, price, cover_image, created_at, last_modified_at, deleted_at)
				VALUES
				(NULL, :id_owner, NULL, :id_author, :id_genre, :name, :isbn, :price, :cover_image, :created_at, :last_modified_at, NULL);')
			){
			throw new \Exception('Could not prepare insertion statement');
		}
		
		$cur_time = date('Y-m-d H:i:s');
		
		if(!$stmt->execute([ // return true if was able to do it
			':id_owner' => $this->id_owner,
			':id_author' => $this->id_author,
			':id_genre' => $this->id_genre,
			':name' => $this->name,
			':isbn' => $this->isbn,
			':price' => $this->price,
			':cover_image' => 'placeholder.png',
			':created_at' => $cur_time,
			':last_modified_at' => $cur_time
		])){
			throw new \Exception('Could not insert user into database');
		};

		return true;
	}
}
