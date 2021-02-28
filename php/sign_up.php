<?php
require_once "utility.php";
require_once "BookshelfDB.php";


//TODO: add everithing in the form were
if(!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['fullname']) || !isset($_POST['birthday']) || !isset($_POST['address']) || !isset($_POST['terms'])){
    conlog("[ERROR] Not all inputs are set!");
    //TODO> Redirect user to apropried page
    exit();
}

$conn = new BookshelfDB();

$conn->insert_user($_POST['email'], $_POST['password'], $_POST['fullname'], $_POST['birthday'], $_POST['address']);
 
conlog("[INFO] User inserted into database successfully!");

// TODO: login user 
header("Location: ../login.html.php");
exit();
