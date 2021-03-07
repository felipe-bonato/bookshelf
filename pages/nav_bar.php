<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/nav_bar.css">

<nav id=nav-bar-c>
    <a id=nav-bar-home href="index.html.php">HOME</a>
    <a id=nav-bar-search href="search.html.php">SEARCH</a>
    <a id=nav-bar-basket href="cart.html.php">CART</a>
<?php
if(isset($_SESSION['email'])){
    $link = "account.html.php";
    $name = $_SESSION['nickname'];
} else {
    $link = "login.html.php";
    $name = "ACCOUNT";
}
echo "<a id=nav-bar-account href=".$link.">".$name."</a>";
?>

</nav>
