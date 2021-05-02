<!--PHP here-->
<?php
$servername = "localhost";
$username = "username";
$dbpass = "password";
$dbname = "database";

// Create connection
$conn = mysqli_connect($servername, $username, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// PHP validation
$error = "";
$successMessage = "";

if ($_POST){
  // Server side validation of fields
  if (!$_POST["name"]){
    $error .= "A name is required.<br>";
  }
  if (!$_POST["email"]){
    $error .= "An email address is required.<br>";
  }
  if (!$_POST["password"]){
    $error .= "A password is required.<br>";
  }
  if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
    $error .= "An email address is not valid.<br>";
  }

  // Error message
  if ($error != ""){
    $error = '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' . $error . '</div>';
  } else{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Check database for same email
    $checkExists = "SELECT `email` FROM users WHERE email = '".$email."'";
    if (mysqli_num_rows(mysqli_query($conn, $checkExists)) > 0){
      $error .= "This email address already exists.";
    } else{
      $query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES('".$name."','".$email."','".$password."')";
      $successMessage = '<div class="alert alert-success" role="alert">Your details have been recieved, signed up!.</div>';
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
        padding: 20px;
        text-align: center;
    }
    </style>
  </head>
  <body>
      <!-- HTML content -->
      <div class="jumbotron" id="main">
        <h1 class="display-4">Sign up for news!</h1>
        <p class="lead">This is just a mock sign-up to check database functionality.</p>
        <hr class="my-4">
        <form>
        <div class="form-group">
              <label for="name">First Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <div id="error"><? echo $error.$successMessage; ?></div>
      </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>