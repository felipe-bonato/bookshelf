<?php session_start();?>

<!DOCTYPE html>
<html>
	<head>
		<title>Bookshelf!</title>
		<?php include "pages/head.php" ?>
		<link rel="stylesheet" href="css/books_container.css">
		<link rel="stylesheet" href="css/page_header.css">
	</head>

	<body>
		<header id=page-header class=logo-text>
			<?php include "pages/logo.php" ?>
			<h1>Bookshelf!</h1>
		</header>
		
		<?php include "pages/nav_bar.php"; ?>

		<main id=books-container>
			<?php
				require_once "php/utility.php";
				require_once "php/BookshelfDB.php";

				$conn = new BookshelfDB($db_config_file_path='php.ini');

				foreach($conn->get_all_books_info() as $book){
					$tag_img = '<img class="book" height="288" width="192" loading="lazy"'.
						'src="users_upload/books_cover/'.$book['cover_image'].'" '.
						'alt="'.$book['name'].'"\'s Cover Image>';
					echo '<a href=book.html.php?id='.$book['id'].'>'.$tag_img.'</a>';
				}
			?>

			<!--a href=book.html.php><img class="book" height="288" width="192" src="users_upload/books_cover/my-beautiful-cover.jpg"></a>
			<a href=book.html.php><img class="book" height="288" width="192" src="https://via.placeholder.com/192x288.png?text=Book+PlaceHolder"></a-->
		</main>
	</body>
</html>
