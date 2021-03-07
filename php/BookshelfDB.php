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
            
            $res_len = count($res); // how much entries mach

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
    public function get_nickname()
    {
        return "Nickname";
    }

    public function list_all_users()
    {
        return $this->query("SELECT * FROM users")->fetchAll();
    }
}

?>