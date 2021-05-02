<?php



    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get data
    // '%webdev.com' is used to match anything that contains that phrase
    // $query = "SELECT * FROM users WHERE email LIKE '%a%'"; 
    // %anything 'search words' %anything else

    // Only selects emails where the id is greater or equal to 2 and has an s in the email
    // $query = "SELECT `email` FROM users WHERE id >= 2 AND email LIKE '%S%'"; 
    
    $name = "rob o' grady";
    // This helps with the above 
    $query = "SELECT `email` FROM users WHERE name = '".mysqli_real_escape_string($conn, $name)."'";

    if ($result = mysqli_query($conn, $query)){
        // Loop through what is available
        while ($row = mysqli_fetch_array($result)){
            print_r($row);
        }
    }

    mysqli_close($conn);
?>