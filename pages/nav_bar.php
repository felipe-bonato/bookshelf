<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/nav_bar.css">

<nav id=nav-bar-c>
    <a href="index.html.php"><div class="nav-bar-item"><img height="22px" width="22px" src="imgs/nav_bar/home.svg" alt=""><span>HOME</span></div></a>
    <!--a href="search.html.php"><div class="nav-bar-item"><img height="20px" width="20px" src="imgs/nav_bar/search.svg" alt=""><span>SEARCH</span></div></a-->
    <?php
if(isset($_SESSION['email'])){
    $link = "account.html.php";
    $name = $_SESSION['nickname'];
    echo '<a href="sell.html.php"><div class="nav-bar-item"><img height="20px" width="20px" src="imgs/nav_bar/sell.svg" alt=""><span>SELL</span></div></a>';
    //echo '<a href="cart.html.php"><div class="nav-bar-item"><img height="20px" width="20px" src="imgs/nav_bar/cart.svg" alt=""><span>CART</span></div></a>';
} else {
    $link = "login.html.php";
    $name = "LOGIN";
}
echo "<a href=".$link.'><div class="nav-bar-item"><img height="20px" width="20px" src="imgs/nav_bar/account.svg" alt=""><span>'.$name."</span></div></a>";
?>

</nav>
