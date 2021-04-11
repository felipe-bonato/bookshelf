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
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo 'Bookshelf! • '.$book["name"].' • '.$book["author"]; ?></title>
		<?php include "pages/head.php" ?>
    	<link rel="stylesheet" href="css/styles.css">
			<link rel="stylesheet" href="css/page_header.css">
			<link rel="stylesheet" href="css/book_edit.css">
	</head>

	<body>
		<?php include "pages/nav_bar.php"; ?>

		<main id=sign-up-c>
			<div id="title-text">
                <span>Edit Book</span>
            </div>
            <form method="POST" action="php/book_edit.php" enctype="multipart/form-data" target="_parent" spellcheck="false" autocapitalize="off" badinput="false">
                <fieldset class="item-grid item-margin">
                    <label>Bookcover</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="8388608"/> <!-- LIMITS IMAGE TO 8Mib -->
                    <input type="file" name="cover_image" id="cover_image" class=input-sizing accept="image/*" value="<?php echo $book["cover_image"]; ?>">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Name</label>
                    <input type="text" name="name" class=input-sizing value="<?php echo $book["name"]; ?>">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Author</label>
                    <input type="text" name="author" class=input-sizing value="I<?php echo $book["author"]; ?>">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>ISBN<label class="sell-optional">(Optional)</label></label>
                    <input type="text" name="isbn" class=input-sizing value="<?php echo $book["isbn"]; ?>">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Genre<label class="sell-optional">(Optional)</label></label>
                    <input type="text" name="genre" class=input-sizing value="<?php echo $book["genre"]; ?>">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Price</label>
                    <input type="number" name="price" class=input-sizing value="<?php echo $book["price"]; ?>">
                </fieldset>
                <fieldset>
                    <input type="hidden" name="book_id" value="<?php echo $_GET["id"] ?>">
                </fieldset>
                <fieldset id="button-c">
                    <button type="submit" class="button-send">
                        <span>Edit</span>
                    </button>
                </fieldset>
            </form>

            <form method="POST" action="php/book_delete.php" target="_parent">
                <fieldset>
                    <input type="hidden" name="book_id" value="<?php echo $_GET["id"] ?>">
                </fieldset>
                <fieldset>
                    <button type="submit" id="book-edit-delete">
                        <span>DELETE</span>
                    </button>
                </fieldset>
            </form>
		</main>
	</body>
</html>
