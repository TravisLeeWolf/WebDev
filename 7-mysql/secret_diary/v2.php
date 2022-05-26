<?php
    // Adding session
    session_start();

    // Database details
    $dbHost = "localhost";
    $dbUser = "username";
    $dbPass = "password";
    $dbName = "database";

    $error = "";

    // Log out user
    if (array_key_exists("logout", $_GET)){
        unset($_SESSION);
        setcookie("id", "", time() - 60);
        $_COOKIE["id"] = "";
    } elseif ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])){
        header("Location: diary-v1.php");
    }

    if(array_key_exists("submit", $_POST)){
        // Connect to database
        $link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
        if (mysqli_connect_error()){
            die("Database Connection Error");
        }

        if (!$_POST['email']){
            $error .= "An email address is required<br>";
        }
        if (!$_POST['password']){
            $error .= "A password is required<br>";
        }
        if ($error != ""){
            $error = "<p>There were error(s) in your form:</p>".$error;
        } else{

            // Check if already signed up
            if ($_POST['signUp'] == 1){
            
                // Check if existing user
                $query = "SELECT id FROM `diary` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                $result = mysqli_query($link, $query);
                if (mysqli_num_rows($result) > 0){
                    $error = "That email address is already taken.";
                } else{
                    $query = "INSERT INTO `diary` (`email`, `password`, `text`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."',NULL)";
                    if (mysqli_query($link, $query)){
                        $error = "<p>Could not sign you up, please try again later.</p>";
                    } else{
                        // Making the users password a hash
                        $query = "UPDATE `diary` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);
                        if ($_POST['stayLoggedIn'] == '1'){
                            setcookie("id", mysqli_insert_id($link), time() + 60*60);
                        }

                        header("Location: diary-v1.php");
                    }
                }
            } else { 
                $query = "SELECT id FROM `diary` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                $result = mysqli_query($link, $query);

                $row = mysqli_fetch_array($result);
                if (isset($row)){
                    $hashedPassword = md5(md5($row['id']).$_POST['password']);
                    if ($hashedPassword == $row['password']){
                        $_SESSION['id'] = $row['id'];
                        if ($_POST['stayLoggedIn'] == 1){
                            setcookie("id", $row['id'], time() + 60*60);
                        }

                        header("Location: diary-v1.php");
                    } else{
                        $error = "That email/password combination could not be found.";
                    }
                } else{
                    $error = "That email/password combination could not be found.";
                }
            }
        } 
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Secret Diary</title>

    <!--CSS here-->
    <style type="text/css">

        html { 
        background: url(diary-background.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        }

        body{
            background: none;
        }
    
        .container{
            text-align: center;
            width: 600px;
            margin-top: 150px;
        }

        .hideMe{
            display: none;
        }
    
    </style>
  </head>
  <body>
      <!-- HTML content -->
    <div class="container">

    <h1 class="display-4">Secret Diary</h1>
    <p class="lead">Try out this secret diary, just sign up or login to continue.</p>
    <hr class="my-4">
    <div id="error"><?php echo $error; ?></div>

    <form method="post" id="signUpForm">
        <p class="lead">Interested? Sign up now!</p>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="stayLoggedIn" id="stayLoggedIn" value="1">
            <label class="form-check-label" for="stayLoggedIn">Stay logged in</label>
        </div>
        <input type="hidden" name="signUp" value="1">
        <button type="submit" class="btn btn-primary" name="submit">Sign Up!</button>
        <p class="lead"><a href="javascript:switchForms()">Log In</a></p>
    </form>

    <form method="post" id="logInForm" class="hideMe">
        <p class="lead">Log in with your username and password.</p>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="stayLoggedIn" id="stayLoggedIn" value="1">
            <label class="form-check-label" for="stayLoggedIn">Stay logged in</label>
        </div>
        <input type="hidden" name="signUp" value="0">
        <button type="submit" class="btn btn-primary" name="submit">Log In!</button>
        <p class="lead"><a href="javascript:switchForms()">Sign Up</a></p>
    </form>

    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <!-- Custom JS -->
    <script type="text/javascript">

        function switchForms(){
            var signUp = document.getElementById("signUpForm");
            var logIn = document.getElementById("logInForm");
            signUp.classList.toggle("hideMe");
            logIn.classList.toggle("hideMe");
        }

    </script>
    
  </body>
</html>