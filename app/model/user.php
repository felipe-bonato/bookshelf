<?php namespace App\Model;

class User extends \Core\Model
{
	public function __construct(array $data)
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
		$this->validate();

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

	public function validate(): void // TODO: maybe return the array of erros?
	{
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$this->errors[] = 'Invalid email';
		}
		if($this->email_exists($this->email)){
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
		
		if(strlen($this->nickname) == 0){
			$this->nickname = 'NULL';
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

	private function email_exists(string $email): bool
	{
		$conn = static::get_db_conection();
		$stmt = $conn->prepare('SELECT COUNT(id) AS email_count FROM user WHERE email = :email');
		
		if($stmt === 0){
			throw new \Exception('Could not prepare query for duplicate emails');
		}
		
		$stmt->execute([':email' => $email]);

		return intval($stmt->fetch()['email_count']) > 0; //TODO: verify this
	}
}
