<?php

    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "database";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Inserting data
    //$query = "INSERT INTO `users` (`email`, `password`) VALUES('bob@webdev.com','yayitsworking')";

    // Updating data
    //$query = "UPDATE `users` SET email = 'frank@webdev.com' WHERE id = 1 LIMIT 1"; // By ID
    $query = "UPDATE `users` SET password = '18shc73h5' WHERE email = 'frank@webdev.com' LIMIT 1";
    mysqli_query($conn, $query);

    // Get data
    $query = "SELECT * FROM users";

    if ($result = mysqli_query($conn, $query)){
        $row = mysqli_fetch_array($result);
        echo "Your email is ".$row[1]." and your password is ".$row[2];
    }

    mysqli_close($conn);
?>