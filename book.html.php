<?php session_start();?>

<?php
	if(!isset($_GET['id'])){
		header("Location: index.html.php"); // TODO BOOK NOT FOUND
	}

	require_once "php/utility.php";
	require_once "php/BookshelfDB.php";

	$conn = new BookshelfDB($db_config_file_path='php.ini');

	if(!$book = $conn->get_book_info($_GET['id'])){
		conlog("[ERROR] Book not found!");
		header("Location: index.html.php");
	}

	if(isset($_SESSION["email"])){
		if($book["owner_id"] == $conn->get_user_id_by_user_email($_SESSION["email"])){
			header("Location: book_edit.html.php?id=".$book["id"]);
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo 'Bookshelf! • '.$book["name"].' • '.$book["author"]; ?></title>
		<?php include "pages/head.php" ?>
    	<link rel="stylesheet" href="css/styles.css">
			<link rel="stylesheet" href="css/page_header.css">
			<link rel="stylesheet" href="css/book.css">
	</head>

	<body>
		<?php include "pages/nav_bar.php"; ?>

		<main id="book-content">
			<img id="book-content-cover"
				height="512"
				width="312"
				src=<?php echo "users_upload/books_cover/".$book['cover_image']; ?>
				alt=<?php echo "".$book['name']."'s Cover Image"; ?>
			>
			<ul id="book-content-detail">
				<li>
					<h1 id="book-content-tittle" class="book-content-item"><?php echo $book['name'] ?></h1>
					<?php
						if(!empty($book['isbn'])){
							echo '<span class="book-content-item-isbn">ISBN: '.$book['isbn'].'</span>';
						}
					?>
				</li>
				<li class="book-content-item">
					<h2 class="book-content-item-tittle">Author</h2>
					<span class="book-content-item-discription"><?php echo $book['author'] ?></span>	
				</li>
				<?php
					if(!empty($book['genre'])){
						echo '<li class="book-content-item">';
						echo '<h2 class="book-content-item-tittle">Genre</h2>';
						echo '<span class="book-content-item-discription">'.$book['genre'].'</span>';
						echo '</li>';
					}
				?>
				<li class="book-content-item">
					<h2 class="book-content-item-tittle">Seller</h2>
					<span class="book-content-item-discription"><?php echo $book['owner_nickname'] ?></span>	
				</li>
				<li class="book-content-item">
					<h2 class="book-content-item-tittle">Price</h2>
					<span class="book-content-item-discription">＄<?php echo $book['price'] ?></span>	
				</li>
				<a id="book-content-buy" href="/buy.html.php" class="book-content-item-tittle">BUY!</a>	
			</ul>
			
				<!--ul id="list-container">
					<li class="item">
							<img height="32px" width="32px" src="imgs/book/author.svg">
							<h2 class="item-tittle">Author</h2>
							<span class="item-discription">Author's Name</span>	
					</li>	
					<li class="item">
						<img height="32px" width="32px" src="imgs/book/seller.svg">
						<h2 class="item-tittle">Seller</h2>
						<span class="item-discription">Seller's Name</span>	
					</li>	
					<li class="item">
						<img height="32px" width="32px" src="imgs/book/price.svg">
						<h2 class="item-tittle">Price</h2>
						<span class="item-discription">$10</span>	
					</li>
					<li class="item">
						<a ref="/buy.html.php" class="item-tittle">BUY!</a>	
					</li>
				</ul-->
		</main>
	</body>
</html>
