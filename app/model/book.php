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
			
		if(!$stmt = $conn->prepare('SELECT book.id AS id, id_owner, id_buyer, id_genre, book.name AS name, author, isbn, price, book_genre.name AS genre_name FROM book INNER JOIN book_genre ON book.id_genre = book_genre.id WHERE book.deleted_at IS NULL')){
			throw new \Exception('Could not prepare fetch book name by book id statement');
		}
		
		if(!$stmt->execute()){
			throw new \Exception('Could not execute database query');
		}

		return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
	}

	public static function get_all_deleted(): array
	{
		$conn = static::get_db_conection();
			
		if(!$stmt = $conn->prepare("SELECT id, id_owner, id_buyer, id_genre, name, author, isbn, price FROM book WHERE book.deleted_at IS NOT NULL;")){
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
				(id, id_owner, id_buyer, id_genre, name, author, isbn, price, created_at, last_modified_at, deleted_at)
				VALUES
				(NULL, :id_owner, NULL, :id_genre, :name, :author, :isbn, :price, :created_at, :last_modified_at, NULL);')
			){
			throw new \Exception('Could not prepare insertion statement');
		}
		
		$cur_time = date('Y-m-d H:i:s');
		
		if(!$stmt->execute([ // return true if was able to do it
			':id_owner' => $this->id_owner,
			':author' => $this->author,
			':id_genre' => $this->id_genre,
			':name' => $this->name,
			':isbn' => $this->isbn,
			':price' => $this->price,
			':created_at' => $cur_time,
			':last_modified_at' => $cur_time
		])){
			throw new \Exception('Could not insert user into database');
		};

		move_uploaded_file($_FILES['cover_image']['tmp_name'], 'C:/wamp64/www/bookshelf/Public/img/users_upload/books_cover/'.$conn->lastInsertId().'.jpg');

		return true;
	}

	public static function get_book_by_id(int $id)
	{
		$conn = static::get_db_conection();
		$stmt = $conn->prepare('SELECT book.id AS id, id_owner, id_buyer, id_genre, book.name AS name, author, isbn, price, book_genre.name AS genre_name FROM book INNER JOIN book_genre ON book.id_genre = book_genre.id WHERE book.id = :id AND book.deleted_at IS NULL');
		
		
		if($stmt === 0){
			throw new \Exception('Could not prepare query for getting user by email');
		}
		
		$stmt->execute([':id' => $id]);

		$stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
		
		return $stmt->fetch() ?? [];
	}

	public function modify(): bool
	{
		//$this->validate_modify_data(); //TODO: ADD THIS BACK <-------------------------------------------------

		if(!empty($this->errors)){
			return false;
		}

		$conn = static::get_db_conection();

		$sql = 'UPDATE book SET
				name=:name,
				author=:author,
				id_genre=:id_genre,
				isbn=:isbn,
				price=:price,
				last_modified_at=:last_modified_at
			WHERE id=:id AND book.deleted_at IS NULL;';
		
		if(!$stmt = $conn->prepare($sql)){
			throw new \Exception('Could not prepare book update statement');
		}

		$cur_datetime = date('Y-m-d H:i:s');
		
		return $stmt->execute([
			':name' => $this->name,
			':author' => $this->author,
			':id_genre' => $this->id_genre,
			':isbn' => $this->isbn,
			':price' => $this->price,
			':last_modified_at' => $cur_datetime,
			':id' => $this->id
		]);
	}

	public function delete()
	{
		//$this->validate_modify_data(); //TODO: ADD THIS BACK <-------------------------------------------------

		if(!empty($this->errors)){
			return false;
		}

		$conn = static::get_db_conection();

		$sql = 'UPDATE book SET deleted_at=:deleted_at WHERE id=:id;';
		
		if(!$stmt = $conn->prepare($sql)){
			throw new \Exception('Could not prepare book update statement');
		}

		$cur_datetime = date('Y-m-d H:i:s');
		
		return $stmt->execute([
			':deleted_at' => $cur_datetime,
			':id' => $this->id
		]);
	}

	public static function get_all_genres(): array
	{
		$conn = static::get_db_conection();
			
		if(!$stmt = $conn->prepare('SELECT book_genre.id AS id, book_genre.name AS name FROM book_genre')){
			throw new \Exception('Could not prepare fetch book genre statement');
		}
		
		if(!$stmt->execute()){
			throw new \Exception('Could not execute database query');
		}
		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
	}
}
