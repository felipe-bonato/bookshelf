<?php session_start();?>

<!DOCTYPE html>
<html>
	<head>
		<title>Bookshelf! • Sell</title>
        <?php include "pages/head.php" ?>
    	<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/sell.css">
	</head>

	<body>
		<?php include "pages/nav_bar.php"; ?>
		<main id=sign-up-c>
			<div id="title-text">
                <img height="23px" width="23px" src="imgs/nav_bar/sell.svg" alt="">
                <span>Sell Book</span>
            </div>
            <form method="POST" action="php/sell.php" enctype="multipart/form-data" target="_parent" spellcheck="false" autocapitalize="off" badinput="false">
                <fieldset class="item-grid item-margin">
                    <label>Bookcover</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="8388608"/> <!-- LIMITS IMAGE TO 8Mib -->
                    <input type="file" name="cover_image" id="cover_image" class=input-sizing accept="image/*">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Name</label>
                    <input type="text" name="name" class=input-sizing placeholder="Insert book name here">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Author</label>
                    <input type="text" name="author" class=input-sizing placeholder="Insert the author here">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>ISBN<label class="sell-optional">(Optional)</label></label>
                    <input type="text" name="isbn" class=input-sizing placeholder="Insert ISBN number here">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Genre<label class="sell-optional">(Optional)</label></label>
                    <input type="text" name="genre" class=input-sizing placeholder="Insert genre name here">
                </fieldset>
                <fieldset class="item-grid item-margin">
                    <label>Price</label>
                    <input type="number" name="price" class=input-sizing placeholder="Insert the price here">
                </fieldset>
                <fieldset id="button-c">
                    <button type="submit" class="button-send">
                        <span>Sell</span>
                    </button>
                </fieldset>
            </form>
		</main>
	</body>
</html>
