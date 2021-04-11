<?php session_start(); ?>

<?php
if(!isset($_SESSION['email']) || !isset($_SESSION['nickname'])){
    conlog("[ERROR] Could not find user!");
    header("Location: index.html.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo 'Bookshelf! • '.mb_convert_case($_SESSION["nickname"], MB_CASE_TITLE, "UTF-8"); ?></title>
        <?php include "pages/head.php" ?>
    	<link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/account.css">
        
        <!---script type="text/php" src="php/login.php"></script-->
	</head>

	<body>
        <?php include "pages/nav_bar.php"; ?>

        <!-- USER INFO -->

        <main id="account-container">
            <div id="account-details-container">
                <h1 class="account-title">Account</h1>
                <div id="button-create-account">
                    <form action="php/logout.php" method="POST">
                        <button type="submit" class="button-send">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- USER BOOKS -->
            <div id="account-your-books-container">
                <h1 class="account-title">Your Books</h1>
            </div>
            
            <div id="account-books-container">
                <ul>
                    <?php
                        require_once "php/utility.php";
                        require_once "php/BookshelfDB.php";
                        
            
                        $conn = new BookshelfDB($db_config_file_path='php.ini');
                    
                        $id = $conn->get_user_id_by_user_email($_SESSION['email']);
                        $books = $conn->get_user_books($id);
                    
                        foreach($books as $book)
                        {
                            echo '<li class="account-book">
                                <a href="book.html.php?id='.$book['id'].'" target="_blank">
                                    <img class="account-book-cover" height="256" width="156" src="users_upload/books_cover/'.$book["cover_image"].'" alt="'.$book["name"].'\'Cover Image">
                                </a>
                                    <ul class="account-book-info">
                                        <li>
                                            <a href="book.html.php?id='.$book['id'].'" target="_blank">
                                                <h1 class="user-book-info-tittle">'.$book["name"].'</h1>
                                            </a>
                                        </li>
                                        <li>
                                            <span>'.$book["author"].'</span>
                                        </li>
                                        <li>
                                            <span>＄'.$book["price"].'</span>
                                        </li>
                                    </ul>
                                
                            </li>';   
                        }
                    ?>
                </ul>
            </div>  
        </main>
	</body>
</html>
