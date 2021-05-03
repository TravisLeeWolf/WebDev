<?php
    
   
    // This is the first level of security but if the user has a common password it can easily be cracked
    //echo md5("password");

    // Using a random string and adding it to our password helps increase security but if hackers get access
    //  to this key they can get all passwords
    //$salt = "wiednvc913540u4tg2vw0vch02w";
    //echo md5($salt."password");

    // Lastly we can use a STATIC attribute from our database for each users, hash that and then apply a hash to their password
    $row['id'] = 73;
    echo md5(md5($row['id'])."password");

    // Note there are still higher forms of security available.

?>