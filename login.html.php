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
        <link rel="stylesheet" href="css/login.css">
        
        <script type="text/php" src="php/login.php"></script>
	</head>

	<body>
        <?php include "pages/page_header_small.php"; ?>
        <?php include "pages/nav_bar.php"; ?>

        <main id="login-c">
            <div id="title-text">
                <span>Login</span>
            </div>
            <form method="POST" action="php/login.php" spellcheck="false" autocapitalize="off" badinput="false">
                <div id="email-c">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Insert username here" autocomplete="username" autofocus="true">
                </div>
                <div id="passwd-c">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Insert password here" autocomplete="password">
                </div>
                <div id="button-c">
                    <button type="submit">
                        <span>Login</span>
                    </button>
                </div>
            </form>

            <div id="button-create-account">
                <span>Dosn't have an account? Create one <a href="sign_up.html.php">HERE!</a></span>
            </div>
        </main>
	</body>
</html>
