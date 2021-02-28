<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Bookshelf!</title>
		<meta charset="UTF-8">

		<link rel="shortcut icon" href="imgs/page_icon.png">
		<?php include "pages/fonts.php"; ?>

    	<link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/account.css">
        
        <!---script type="text/php" src="php/login.php"></script-->
	</head>

	<body>
        <?php include "pages/page_header_small.php"; ?>

        <?php include "pages/nav_bar.php"; ?>

        <main id="login-c">
            <div id="title-text">
                <span>Account</span>
            </div>
            <!--form method="POST" action="php/login.php" spellcheck="false" autocapitalize="off" badinput="false">
                <div id="email-c">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Insert username here" autocomplete="username" autofocus="true">
                </div>
                <div id="passwd-c">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Insert password here" autocomplete="password">
                </div>
            </form-->

            <div id="button-create-account">
                <form action="php/logout.php" method="POST">
                    <button type="submit" class="button-send">
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </main>
	</body>
</html>
