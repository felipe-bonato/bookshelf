<?php
session_start();
/*
LOGIN.PHP
 - Processes login and set cookies
*/
require_once "utility.php";
require_once "BookshelfDB.php";

if(!isset($_POST['email']) || !isset($_POST['password'])){
    conlog("[ERROR] Email and password not set!");
    exit(); // TODO: Redirect user to apropried page
}

$usr_email = $_POST['email'];
$usr_password = $_POST['password'];

$conn = new BookshelfDB();

if(!$conn->validate_login($usr_email, $usr_password)){
    conlog("[ERROR] Could not login / Wrong username and password");
    exit();
}

conlog("[INFO] User login succesfull");

$_SESSION['email'] = $usr_email;
$_SESSION['nickname'] = $conn->get_nickname(); //TODO: ADD NICKNAME SYSTEM

header("Location: /bookshelf/index.html.php");