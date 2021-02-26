<?php
session_start();
require_once "utility.php";

$conn = db_connect();

//TODO: add everithing in the form were
if(!$_POST['email'] || !$_POST['password']){
    conlog("[ERROR] Email and password not set!");
//TODO> Redirect user to apropried page
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];
$terms = $_POST['terms'];

echo "Email: ".$email."\n";
echo "Password: ".$password."\n";
echo "Fullname: ".$fullname."\n";
echo "Age: ".$birthday."\n";
echo "Address: ".$address."\n";
echo "Terms: ".$terms."\n";

$query = "INSERT INTO users (id, email, password, fullname, birthday, address, deleted) VALUES (NULL, '".$email."', '".$password."', '".$fullname."', '".$birthday."', '".$address."', 0);";

echo $query."\n";

if(!mysqli_query($conn, $query)){
    conlog("[ERROR] Could not insert into database!");
    exit();
} 
conlog("[INFO] User inserted into database successfully!");
/*
if(!$row = mysqli_fetch_assoc(
    mdysqli_query($conn,
//TODO: fix sql injection 
        "SELECT * FROM users WHERE email=\"".$email."\" AND password=\"".$password."\";"))){

    conlog("[ERROR] Wrong username and password!");
//TODO: Redirect user to aproried page  
    echo "<h1>Wrong email or password</h1>";
    exit();
}
$_SESSION['logged'] = true;
$_SESSION['email'] = $email;

conlog("[INFO] User login succesfull");

echo "<h1> Login feito com sucesso</h1>";
*/
header("Location: index.html");
exit();
