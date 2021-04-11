<?php
/*
Bookshelf Database PHP Data Object
*/
class BookshelfDB extends PDO
{
	public function __construct($db_config_file_path = "../php.ini")
	{
		if(!$db_config = parse_ini_file($db_config_file_path, true)){
			throw new Exception("Could not load database config file");
		}

		$dsn = $db_config['db']['driver'].":dbname=".$db_config['db']['schema'].";host".$db_config['db']['host'];

		try {
			parent::__construct($dsn, $db_config['db']['username'], $db_config['db']['password']);

			if(!$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false)){ //For allowing the prepere mathod to block sql injections
				throw new Exception("Could not set database config");
			}
		} catch(PDOException $e) {
			conlog("[ERROR] Could not connect to database");
			conlog("[ERROR MSG] ".$e->getMessage());

			exit();
		}
	}

	public function insert_user($email, $password, $fullname, $nickname=null, $birthday, $address)
	{
		// DATA TREATMENT
		if(!isset($email)) throw new Exception("Email is not set");
		if(!isset($password)) throw new Exception("Password is not set");
		if(!isset($fullname)) throw new Exception("Fullname is not set");
		if(!isset($birthday)) throw new Exception("Birthday is not set");
		if(!isset($address)) throw new Exception("Address is not set");

		// this validates the birthday as a valid date
		if(!$formated_birthday = DateTime::createFromFormat("Y-m-d", $birthday)){
			throw new Exception("Birthday is not valid");
		}
		// gets back the date in a format which the db accepts
		$formated_birthday = $formated_birthday->format('Y-m-d');
		
		if(!$hashed_password = password_hash($password, PASSWORD_DEFAULT)){
			throw new Exception("Password is not valid");
		}
		
		// INSETION
		try {
			if(!$insert_stmt = $this->prepare(
					"INSERT INTO users
					(id, email, password, fullname, nickname, birthday, address, deleted)
					VALUES
					('', :email, :password, :fullname, :nickname, :birthday, :address, :deleted);")
				){
				throw new Exception("Could not prepare insertion statement");
			}

			return $insert_stmt->execute([ // return true if is able to do it
				':email' => $email,
				':password' => $hashed_password,
				':fullname' => $fullname,
				':nickname' => $nickname,
				':birthday' => $formated_birthday,
				':address' => $address,
				':deleted' => 0
			]);
			
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute insertion");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}
	}

	/*
	Validate login's email and password with database
	Returns true if email and password is correct and false if it isn't
	*/
	public function validate_login($email, $password)
	{
		try {
			if(!$search_stmt = $this->prepare("SELECT * FROM users WHERE email=:email;")){
				throw new Exception("Could not prepare validation statement");
			}

			if(!$search_stmt->execute([':email' => $email])){
				throw new Exception("Could not execute database query");
			}

			$res = $search_stmt->fetchAll(); // fetch all returns a vector of vectors [line][column]
			
			$res_len = count($res); // how much entries match

			// if there is only one match in database
			if($res_len === 1){
				return  password_verify($password, $res[0]['password']);
			}

			if($res_len === 0){
				throw new Exception("User not in database");
			}

			if($res_len > 1){
				throw new Exception("Multiple users registred in database");
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute login validation");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}
	}

	// TODO: ADD NICKNAME SYSTEM
	/* Get's nickname from email
	 * @returns string: Nickname 
	 */
	public function get_nickname($email)
	{
		try {
			if(!$nickname_stmt = $this->prepare("SELECT nickname FROM users WHERE email=:email;")){
				throw new Exception("Could not prepare nickname statement");
			}

			if(!$nickname_stmt->execute([':email' => $email])){
				throw new Exception("Could not execute database query");
			}

			$res = $nickname_stmt->fetchAll(); // fetch all returns a vector of vectors [line][column]
			
			$res_len = count($res); // how much entries match

			// if there is only one match in database
			if($res_len === 1){
				return $res[0]['nickname'];
			}

			if($res_len === 0){
				throw new Exception("User not in database");
			}

			if($res_len > 1){
				throw new Exception("Multiple users registred in database");
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute nick fetch");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}
	}

	public function list_all_users()
	{
		return $this->query("SELECT * FROM users")->fetchAll();
	}

	/*
	 * Inserts book in database
	 */
	public function insert_book(
		string $name,
		string $cover_image,
		string $author,
		string $genre=null,
		string $isbn=null,
		string $email,
		float  $price): bool
	{
		// DATA TREATMENT
		if(empty($name)) throw new Exception("Book name is empty");
		if(empty($cover_image)) throw new Exception("Book Cover Image is empty");
		if(empty($author)) throw new Exception("Book Author is emptyt");
		if(empty($email)) throw new Exception("User Email is empty");
		if($price < 0 || $price > 1000){
			throw new Exception("Book Price must be between 1 and 1000");
		}

		$user_id = $this->get_user_id_by_user_email($email);

		// INSERTION
		try {
			if(!$insert_stmt = $this->prepare(
					"INSERT INTO books
					(id, name, cover_image, author, genre, isbn, owner, price)
					VALUES
					('', :name, :cover_image, :author, :genre, :isbn, :owner, :price);")
				){
				throw new Exception("Could not prepare insertion statement");
			}

			return $insert_stmt->execute([ // return true if is able to do it
				':name' => $name,
				':cover_image' => $cover_image,
				':author' => $author,
				':genre' => $genre,
				':isbn' => $isbn, 
				':owner' => $user_id,
				':price' => $price
			]);
			
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute insertion");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}
	}

	public function alter_book(
		int    $id,
		string $name,
		string $cover_image,
		string $author,
		string $genre=null,
		string $isbn=null,
		string $email,
		float  $price
	): bool
	{
		// DATA TREATMENT
		if(empty($name)) throw new Exception("Book name is empty");
		if(empty($cover_image)) throw new Exception("Book Cover Image is empty");
		if(empty($author)) throw new Exception("Book Author is emptyt");
		if(empty($email)) throw new Exception("User Email is empty");
		if($price < 0 || $price > 1000){
			throw new Exception("Book Price must be between 1 and 1000");
		}

		$user_id = $this->get_user_id_by_user_email($email);

		// UPDATE
		try {
			if(!$update_stmt = $this->prepare(
					"UPDATE `books` SET `name` = :name, cover_image = :cover_image, author = :author, genre = :genre, isbn = :isbn, `owner` = :owner, price = :price WHERE `books`.`id` = :id;")
				){
				throw new Exception("Could not prepare update statement");
			}

			return $update_stmt->execute([ // return true if is able to do it
				':id' => $id,
				':name' => $name,
				':cover_image' => $cover_image,
				':author' => $author,
				':genre' => $genre,
				':isbn' => $isbn, 
				':owner' => $user_id,
				':price' => $price
			]);
			
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute update");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}
	}

	/* Get's nickname from email
	 * @returns string: Nickname 
	 */
	public function get_book_info($id)
	{
		try {
			if(!$get_book_name_stmt = $this->prepare("SELECT `name`, `cover_image`, `author`, `genre`, `isbn`, `owner`, `price` FROM books WHERE id=:id;")){
				throw new Exception("Could not prepare fetch book name by book id statement");
			}
			
			if(!$get_book_name_stmt->execute([':id' => $id])){
				throw new Exception("Could not execute database query");
			}
			
			if($res = $get_book_name_stmt->fetch(PDO::FETCH_ASSOC)){
				
					if(!$nickname = $this->get_nickname_by_id($res['owner'])){
						throw new Exception("Could not get nickname from id");
					}
					$res['id'] = $id;
					$res['owner_id'] = $res['owner'];
					$res['owner_nickname'] = $nickname;
					return $res;
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute book name fetch");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}
	}

	public function get_all_books_info(): array
	{
		try {
			if(!$get_book_name_stmt = $this->prepare("SELECT `id`, `name`, `author`, `owner`, `cover_image`, `price` FROM books;")){
				throw new Exception("Could not prepare fetch book name by book id statement");
			}
			
			if(!$get_book_name_stmt->execute()){
				throw new Exception("Could not execute database query");
			}
			
			if($res = $get_book_name_stmt->fetchAll(PDO::FETCH_ASSOC)){
				return $res;
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute book name fetch");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}		
	}

	public function get_nickname_by_id($id)
	{
		try {
			if(!$nickname_stmt = $this->prepare("SELECT nickname FROM users WHERE id=:id;")){
				throw new Exception("Could not prepare nickname statement");
			}

			if(!$nickname_stmt->execute([':id' => $id])){
				throw new Exception("Could not execute database query");
			}

			$res = $nickname_stmt->fetchAll(); // fetch all returns a vector of vectors [line][column]
			
			$res_len = count($res); // how much entries match

			// if there is only one match in database
			if($res_len === 1){
				return $res[0]['nickname'];
			}

			if($res_len === 0){
				throw new Exception("User not in database");
			}

			if($res_len > 1){
				throw new Exception("Multiple users registred in database");
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute nick fetch");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}		
	}

	public function get_user_id_by_user_email(string $email): int
	{
		try {
			if(!$search_stmt = $this->prepare("SELECT * FROM users WHERE email=:email;")){
				throw new Exception("Could not prepare fetch id from email statement");
			}

			if(!$search_stmt->execute([':email' => $email])){
				throw new Exception("Could not execute database query");
			}

			if($res = $search_stmt->fetch(PDO::FETCH_ASSOC)){
				return intval($res['id']);
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute login validation");
			conlog("[ERROR MSG] ".$e->getMessage());
			throw new Exception("Could not execute login validation; ".$e->getMessage());
		}
	}

	public function get_user_books(int $user_id)
	{
		try {
			if(!$get_book_name_stmt = $this->prepare("SELECT `id`, `name`, `cover_image`, `author`, `genre`, `isbn`, `owner`, `price` FROM books WHERE `owner`=:owner;")){
				throw new Exception("Could not prepare fetch book name by owner statement");
			}
			
			if(!$get_book_name_stmt->execute([':owner' => $user_id])){
				throw new Exception("Could not execute database query");
			}
			
			if($res = $get_book_name_stmt->fetchAll(PDO::FETCH_ASSOC)){
				return $res;
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute book name fetch");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}		
	}

	public function delete_book(int $id)
	{
		try {
			if(!$get_book_name_stmt = $this->prepare("DELETE FROM `books` WHERE `books`.`id` = :id")){
				throw new Exception("Could not prepare delete statement");
			}
			
			if(!$get_book_name_stmt->execute([':id' => $id])){
				throw new Exception("Could not execute delete");
			}
		} catch(Exception | PDOException $e) {
			conlog("[ERROR] Could not execute delete");
			conlog("[ERROR MSG] ".$e->getMessage());
			return false;
		}	
	}
}

?>