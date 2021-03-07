<?php
/*
    Prints a messege to the browser's console
*/
function conlog($messege) {
    echo "<script>console.log('".$messege."');</script>";
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
