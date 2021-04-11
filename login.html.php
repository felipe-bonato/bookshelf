<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Bookshelf! • Login</title>
        <?php include "pages/head.php" ?>	
    	<link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/login.css">
        
        <script type="text/php" src="php/login.php"></script>
	</head>

	<body>
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
                    <button type="submit" class="button-send">
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
