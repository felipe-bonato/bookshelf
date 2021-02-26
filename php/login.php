<?php
session_start();
require_once "utility.php";

$conn = db_connect();

if(!$_POST['email'] || !$_POST['password']){
    conlog("[ERROR] Email and password not set!");
// TODO: Redirect user to apropried page
    exit();
}
$email = $_POST['email'];
$password = $_POST['password'];

if(!$row = mysqli_fetch_assoc(
    mysqli_query($conn,
//TODO: fix sql injection 
        "SELECT * FROM users WHERE email=\"".$email."\" AND password=\"".$password."\";"))){

    conlog("[ERROR] Wrong username and password!");
//TODO: Redirect user to aproried page  
    echo "<h1>Wrong email or password</h1>";
    exit();
}


$_SESSION['logged'] = true;
$_SESSION['email'] = $email;

//TODO: FIX THIS SHIT
$_SESSION['nickname'] = explode(' ',
    strtoupper(mysqli_fetch_assoc(
        mysqli_query($conn,
            "SELECT fullname FROM users WHERE email=\"".$email."\";"))['fullname']))[0];

conlog("[INFO] User login succesfull");

header("Location: /bookshelf/index.html.php");