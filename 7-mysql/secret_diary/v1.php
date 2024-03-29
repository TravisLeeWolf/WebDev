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
                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                $result = mysqli_query($link, $query);
                if (mysqli_num_rows($result) > 0){
                    $error = "That email address is already taken.";
                } else{
                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
                    if (mysqli_query($link, $query)){
                        $error = "<p>Could not sign you up, please try again later.</p>";
                    } else{
                        // Making the users password a hash
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);
                        if ($_POST['stayLoggedIn'] == '1'){
                            setcookie("id", mysqli_insert_id($link), time() + 60*60);
                        }

                        header("Location: diary-v1.php");
                    }
                }
            } else { 
                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
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

<form method="post">
    <input type="email" name="email" placeholder="Your Email">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="stayLoggedIn" value="1">
    <!--hidden doesn't display but we can still use it in code-->
    <input type="hidden" name="signUp" value="1">
    <input type="submit" name="submit" value="Sign up!">
</form>

<form method="post">
    <input type="email" name="email" placeholder="Your Email">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="stayLoggedIn" value="1">
    <input type="hidden" name="signUp" value="0">
    <input type="submit" name="submit" value="Log In!">
</form>