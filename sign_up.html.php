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
		<link rel="stylesheet" href="css/sign_up.css">
	</head>

	<body>
        <?php include "pages/page_header_small.php"; ?>
		<?php include "pages/nav_bar.php"; ?>

		<main id=sign-up-c>
			<div id="title-text">
                <span>Sign Up!</span>
            </div>
            <form method="POST" action="php/sign_up.php" spellcheck="false" autocapitalize="off" badinput="false">
                <fieldset id="email-c" class="item-grid item-margin">
                    <label>Email</label>
                    <input type="email" name="email" class=input-sizing placeholder="Insert email here" autocomplete="username" autofocus="true">
                </fieldset>
                <fieldset id="password-c" class="item-grid item-margin">
                    <label>Password</label>
                    <input type="password" name="password" class=input-sizing placeholder="Insert password here" autocomplete="password">
                </fieldset>
				<fieldset id="fullname-c" class="item-grid item-margin">
                    <label>Full Name</label>
                    <input type="text" name="fullname" class=input-sizing placeholder="Insert your full name here" autocomplete="name">
                </fieldset>
				<fieldset id="birthday-c" class="item-grid item-margin">
                    <label>Birthday</label>
                    <input type="date" name="birthday" class=input-sizing placeholder="Insert your birthday here" autocomplete="bday">
                </fieldset>
				<fieldset id="address-c" class="item-grid item-margin">
                    <label>Address</label>
                    <input type="text" name="address" class=input-sizing placeholder="Insert your address here" autocomplete="address-level1">
                </fieldset>
				<fieldset id="terms-c" class=item-margin>
                    <input type="checkbox" name="terms" />
                    <label>I agree with the <a href="terms.html.php">Terms and Conditions</a></label>
                </fieldset>
                <fieldset id="button-c">
                    <button type="submit">
                        <span>Sign Up</span>
                    </button>
                </fieldset>
            </form>
		</main>
	</body>
</html>
