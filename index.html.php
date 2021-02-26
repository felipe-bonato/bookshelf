<?php
session_start();
require_once "php/utility.php";

if(!isset($_SESSION['email']) or !isset($_SESSION['logged'])){
	conlog("[INFO] No session detected");
} else {
	conlog("Logged: ".$_SESSION['logged']);
	conlog("Email: ".$_SESSION['email']);
	conlog("Nickname: ".$_SESSION['nickname']);
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
		<link rel="stylesheet" href="css/books_container.css">
		<link rel="stylesheet" href="css/page_header.css">
	</head>

	<body>
		<header id=page-header class=logo-text>
			<h1>Bookshelf!</h1>
		</header>
		
		<?php include "pages/nav_bar.php"; ?>

		<main id=books-container>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
			<a href=#><img src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a>
		</main>
	</body>
</html>
