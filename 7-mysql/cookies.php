<?php
    // Set up the cookie, this can be deleted but the cookie will remain for 60sec * 60min so an hour
    setcookie("customerId", "1234", time() + 60*60);
    echo $_COOKIE["customerId"];
    // To delete a cookie, timer needs to be set in the past, this doesn't update the value of the cookie
    setcookie("customerId", "", time() - 60*60);


?>