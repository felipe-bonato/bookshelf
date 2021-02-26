<?php

function conlog($messege) {
    echo "<script>console.log('".$messege."');</script>";
}

function db_connect(){
    $db_host = "127.0.0.1"; //server ip, 127.0.0.1 is localhost
    $db_user = "root";
    $db_pass = "";          //blank if it dosen't has a password
    $db_name = "bookshelf"; //database to connect to

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if($errno = mysqli_connect_errno()){
        conlog("[ERROR][".$errno."] Could not connect to database!");
    //TODO: Redirect user to apropied page    
        exit();
    } 
    conlog("[INFO] Connection made with database sucefully");
    return $conn;
}

function session_end() {
    if($_SESSION){
        $_SESSION = array();
    
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy(); 
    }
    
}
