<?php namespace App\Model;

class User extends \Core\Model
{
	public function __construct(array $data=[])
	{
		foreach($data as $key => $value){
			$this->$key = $value;
		}
	}

	/**
	 * @return bool true on success, false on failure
	 */
	public function insert(): bool
	{
		$this->validate_register_data();

		if(!empty($this->errors)){
			return false;
		}

		if(!$this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT)){
			$this->errors[] = 'Invalid password';
			return false;
		}

		$conn = static::get_db_conection();

		
		if(!$stmt = $conn->prepare(
				'INSERT INTO user
				(id, email, password, fullname, nickname, birthday, address, created_at, deleted)
				VALUES
				(NULL, :email, :password, :fullname, :nickname, :birthday, :address, \''.date('Y-m-d H:i:s').'\', 0);')
			){
			throw new \Exception('Could not prepare insertion statement');
		}
			
		if(!$stmt->execute([ // return true if was able to do it
			':email' => $this->email,
			':password' => $this->hashed_password,
			':fullname' => $this->fullname,
			':nickname' => $this->nickname,
			':birthday' => $this->birthday,
			':address' => $this->address
		])){
			throw new \Exception('Could not insert user into database');
		};

		return true;
	}

	public function validate_register_data(): void // TODO: maybe return the array of erros?
	{
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$this->errors[] = 'Invalid email';
		}
		if(static::email_exists($this->email)){
			$this->errors[] = 'Email already registred';
		}

		if(strlen($this->password) < 8){
			$this->errors[] = 'Password must have at least 8 charactes';
		}

		if(!preg_match('/.*[a-z]+.*/i', $this->password)) {
			$this->errors[] = 'Password must have at least 1 letter';
		}
		
		if(!preg_match('/.*\d+.*/i', $this->password)) {
			$this->errors[] = 'Password must have at least 1 number';
		}

		if(strlen($this->fullname) == 0){
			$this->errors[] = 'Name must be set';
		}
		
		if(strlen($this->address) < 6){
			$this->errors[] = 'Invalid Address';
		}
		
		// Special Cases
		
		if(empty($this->nickname) == 0){
			$fullname_arr = explode(' ', $this->fullname);
			$this->nickname = $fullname_arr[0];
		}

		if(!$this->birthday = \DateTime::createFromFormat('Y-m-d', $this->birthday)){
			$this->errors[] = 'Invalid birthday';
		} else {
			if(!$this->birthday = $this->birthday->format('Y-m-d')){
				$this->errors[] = 'Invalid birthday';
			} else {
				if($this->birthday < '1900-01-01'){
					$this->errors[] = 'I doubt that you were born before 1900';
				}
			}
		}
	}

	public static function email_exists(string $email): bool
	{
		return !empty(User::get_user_by_email($email));
	}

	public static function get_user_by_email(string $email)
	{
		$conn = static::get_db_conection();
		$stmt = $conn->prepare('SELECT * FROM user WHERE email = :email');
		
		if($stmt === 0){
			throw new \Exception('Could not prepare query for getting user by email');
		}
		
		$stmt->execute([':email' => $email]);

		$stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
		$res = $stmt->fetch();

		return $res;
	}

	public static function get_user_by_id(int $id)
	{
		$conn = static::get_db_conection();
		$stmt = $conn->prepare('SELECT * FROM user WHERE user.id = :id');
		
		if($stmt === 0){
			throw new \Exception('Could not prepare query for getting user by email');
		}
		
		$stmt->execute([':id' => $id]);

		$stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
		$res = $stmt->fetch();

		return $res;
	}

	/**
	 * @return bool|User Returns false on wrong password and/or email; else returns the User object
	 */
	public static function authenticate(string $email, string $password)
	{
		$user = static::get_user_by_email($email);
		if(!$user){
			return false;
		}

		if(!password_verify($password, $user->password)){
			return false;
		}

		return $user;
	}

	public function modify(): bool
	{
		$this->validate_modify_data();

		if(!empty($this->errors)){
			return false;
		}

		$conn = static::get_db_conection();

		$user = \App\Auth::get_user();

		if(isset($this->password) && !empty($this->password)){
			$sql = 'UPDATE user SET
						email=:email,
						password=:password,
						fullname=:fullname,
						nickname=:nickname,
						birthday=:birthday,
						address=:address
					WHERE id=:id;';
		} else {
			$sql = 'UPDATE user SET
						email=:email,
						fullname=:fullname,
						nickname=:nickname,
						birthday=:birthday,
						address=:address
					WHERE id=:id;';
		}

		var_dump($sql);

		if(!$stmt = $conn->prepare($sql)){
			throw new \Exception('Could not prepare insertion statement');
		}

		$this->id = 
		var_dump($this);

		if(isset($this->password) && !empty($this->password)){
			if(!$this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT)){
				$this->errors[] = 'Invalid password';
				return false;
			}
			$query_arr = [
				':email' => $this->email,
				':password' => $this->hashed_password,
				':fullname' => $this->fullname,
				':nickname' => $this->nickname,
				':birthday' => $this->birthday,
				':address' => $this->address,
				':id' => $user->id
			];
		} else {
			$query_arr = [
				':email' => $this->email,
				':fullname' => $this->fullname,
				':nickname' => $this->nickname,
				':birthday' => $this->birthday,
				':address' => $this->address,
				':id' => $user->id
			];
		}
		
		return $stmt->execute($query_arr);
	}

	public function validate_modify_data(): void
	{
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$this->errors[] = 'Invalid email';
		}

		$user = \App\Auth::get_user();
		if($this->email != $user->email){
			if(static::email_exists($this->email)){
				$this->errors[] = 'Email already registred';
			}
		}

		if(isset($this->password) && !empty($this->password)){
			if(strlen($this->password) < 8){
				$this->errors[] = 'Password must have at least 8 charactes';
			}

			if(!preg_match('/.*[a-z]+.*/i', $this->password)) {
				$this->errors[] = 'Password must have at least 1 letter';
			}
			
			if(!preg_match('/.*\d+.*/i', $this->password)) {
				$this->errors[] = 'Password must have at least 1 number';
			}
		}

		if(strlen($this->fullname) == 0){
			$this->errors[] = 'Name must be set';
		}
		
		if(strlen($this->address) < 6){
			$this->errors[] = 'Invalid Address';
		}
		
		// Special Cases
		
		if(empty($this->nickname) == 0){
			$fullname_arr = explode(' ', $this->fullname);
			$this->nickname = $fullname_arr[0];
		}

		if(!$this->birthday = \DateTime::createFromFormat('Y-m-d', $this->birthday)){
			$this->errors[] = 'Invalid birthday';
		} else {
			if(!$this->birthday = $this->birthday->format('Y-m-d')){
				$this->errors[] = 'Invalid birthday';
			} else {
				if($this->birthday < '1900-01-01'){
					$this->errors[] = 'I doubt that you were born before 1900';
				}
			}
		}
	}

	public static function get_all(): array
	{
		$conn = static::get_db_conection();
		
		if(!$stmt = $conn->prepare("SELECT `id`, `id_user_type`, `email`, `password`, `fullname`, `nickname`, `birthday`, `address`, `created_at`, `deleted_at` FROM `user`;")){
			throw new \Exception("Could not prepare fetch user query");
		}
		
		if(!$stmt->execute()){
			throw new \Exception("Could not execute database query");
		}
		
		if($res = $stmt->fetchAll(\PDO::FETCH_ASSOC)){ //TODO: THIS MIGHT NEED TO CHANGE
			return $res;
		}
	}
}
