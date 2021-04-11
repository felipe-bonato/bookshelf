<?php
session_start();

require_once "utility.php";
require_once "BookshelfDB.php";

if(!isset($_SESSION['email'])){
    conlog("[ERROR] User is not logged\nHow tf did you manege to get this error, this sloud not happen");
    exit();
}

$conn = new BookshelfDB();

$conn->delete_book($_POST['book_id']);

conlog("[INFO] Book deleted from database successfully!");

// TODO: Redirect user to book page
header("Location: ../index.html.php");
exit();
