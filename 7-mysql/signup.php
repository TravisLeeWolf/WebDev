<!--PHP here-->
<?php
$servername = "localhost";
$username = "username";
$dbpass = "password";
$dbname = "database";

// Keeping the session going
session_start();
echo $_SESSION['username'];

// Check if data has been inputted
if (array_key_exists('name', $_POST) OR array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){

  // Connect to database
  // Create connection
  $conn = mysqli_connect($servername, $username, $dbpass, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if ($_POST['name'] == ''){
      echo "<p>A name is required.</p>";
  } elseif ($_POST['email'] == ''){
      echo "<p>An email address is required.</p>";
  } elseif ($_POST['password'] == ''){
      echo "<p>A password is required.</p>";
  } else { 
      $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0){
        echo "<p>That email address has already been taken.</p>";
      } else{
        $query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".mysqli_real_escape_string($conn, $_POST['name'])."', '".mysqli_real_escape_string($conn, $_POST['email'])."', '".mysqli_real_escape_string($conn, $_POST['password'])."')";
        if (mysqli_query($conn, $query)){
          $_SESSION['email'] = $_POST['email'];
          header("Location: session.php");
        } else{
          echo "<p>There was a problem signing up, please try again later.</p>";
        }
      }
  }
}


// Closes the database
mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>PHP Simple Sign-up</title>

    <!--CSS here-->
    <style type="text/css">
    #main{
        width: 800px;
        height: 500px;
        margin: 0 auto;
        text-align: center;
    }
    </style>
  </head>
  <body>
      <!-- HTML content -->
      <h2>Simple Sign Up</h2>
      <p>This is a simple sign up page using PHP and mySQL</p>
      <hr>
      <!--Here method is VERY IMPORTANT to signal to php it will be used!-->
      <form method="post">
        <input name="name" type="text" placeholder="First Name">
        <input name="email" type="text" placeholder="Email Address">
        <input name="password" type="password" placeholder="Password">
        <input type="submit" value="Sign Up">
      </form>
  </body>
</html>