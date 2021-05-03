<?php

    session_start();

    // This assings the name to the session and is held until the browser is closed
    //$_SESSION['username'] = "webdev";
    // You can remove the above after loading the page with it and then remove it but still be logged in the same session
    //echo $_SESSION['username'];

    if ($_SESSION['email']){
        echo "You are logged in!";
    } else{
        header("Location: signup.php");
    }

?>