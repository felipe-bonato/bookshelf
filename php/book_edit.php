<?php
session_start();

require_once "utility.php";
require_once "BookshelfDB.php";

if(!isset($_SESSION['email'])){
    conlog("[ERROR] User is not logged\nHow tf did you manege to get this error, this sloud not happen");
    exit();
}

if(!isset($_POST['name']) || !isset($_POST['author']) || !isset($_POST['price'])){
    conlog("[ERROR] Not all inputs are set!");
    //TODO: Redirect user to apropried page
    exit();
}

if(isset($_POST['genre'])){
    $genre = $_POST['genre'];
} else {
    $genre = null;
}

if(isset($_POST['isbn'])){
    $isbn = $_POST['isbn'];
} else {
    $isbn = null;
}

// Renaming the file to its hash
// So if a user uploads a file with the same name as other it doesn't overwrite it
$image_hash = hash_file("sha3-512", $_FILES['cover_image']['tmp_name'], $raw_output=false);
// Getting the extention
$image_type = pathinfo($_FILES['cover_image']['name'], $flags=PATHINFO_EXTENSION);
// Final name
$image_name = "".$image_hash.".".$image_type;

$file_destination = "".$USER_UPLOADED_FILES."/books_cover/".basename($image_name);

if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $file_destination)) {
    conlog("[ERROR] Unable to upload file");
    exit();
}

$conn = new BookshelfDB();

$conn->alter_book(
    $_POST['book_id'],
    $_POST['name'],
    $image_name,
    $_POST['author'],
    $genre,
    $isbn,
    $_SESSION['email'],
    floatval($_POST['price'])
);

conlog("[INFO] Book updated into database successfully!");

// TODO: Redirect user to book page
header("Location: ../index.html.php");
exit();
