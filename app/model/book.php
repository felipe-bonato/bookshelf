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
		$conn = static::get_db_conection();
			
		if(!$stmt = $conn->prepare("SELECT id, id_owner, id_buyer, id_genre, name, author, isbn, price, cover_image FROM book WHERE book.deleted_at IS NULL;")){
			throw new \Exception("Could not prepare fetch book name by book id statement");
		}
		
		if(!$stmt->execute()){
			throw new \Exception("Could not execute database query");
		}
		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
	}

	public static function get_all_deleted(): array
	{
		$conn = static::get_db_conection();
			
		if(!$stmt = $conn->prepare("SELECT id, id_owner, id_buyer, id_genre, name, author, isbn, price, cover_image FROM book WHERE book.deleted_at IS NOT NULL;")){
			throw new \Exception("Could not prepare fetch book name by book id statement");
		}
		
		if(!$stmt->execute()){
			throw new \Exception("Could not execute database query");
		}
		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
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
				(id, id_owner, id_buyer, id_genre, name, author, isbn, price, cover_image, created_at, last_modified_at, deleted_at)
				VALUES
				(NULL, :id_owner, NULL, :id_genre, :name, :author, :isbn, :price, :cover_image, :created_at, :last_modified_at, NULL);')
			){
			throw new \Exception('Could not prepare insertion statement');
		}
		
		$cur_time = date('Y-m-d H:i:s');
		
		if(!$stmt->execute([ // return true if was able to do it
			':id_owner' => $this->id_owner,
			':id_author' => $this->author,
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
