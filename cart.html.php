<?php
session_start();
require_once "php/utility.php";

if(!isset($_SESSION['email']) or !isset($_SESSION['logged'])){
	conlog("[INFO] No session detected");
} else {
	conlog("Logged: ".$_SESSION['logged']);
	conlog("Email: ".$_SESSION['email']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bookshelf!</title>
		<meta charset="UTF-8">

		<link rel="shortcut icon" href="imgs/page_icon.png">
		<?php include "pages/fonts.php"; ?>
		
    	<link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <?php include "pages/page_header_small.php"; ?>
        <?php include "pages/nav_bar.php"; ?>
    </body>
</html>
