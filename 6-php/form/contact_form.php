<?php

  $error = "";
  $successMessage = "";

  if ($_POST){
    // Server side validation of fields
    if (!$_POST["email"]){
      $error .= "An email address is required.<br>";
    }
    if (!$_POST["content"]){
      $error .= "The content field is required.<br>";
    }
    if (!$_POST["subject"]){
      $error .= "The subject is required.<br>";
    }
    if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
      $error .= "An email address is not valid.<br>";
    }

    // Error message
    if ($error != ""){
      $error = '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' . $error . '</div>';
    } else{
      $emailTo = $_POST["email"];
      $subject = $_POST["subject"];
      $content = $_POST["content"];
      $headers = "From: ".$_POST["email"];

      if (mail($emailTo, $subject, $content, $headers)){
        $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
      } else{
        $error = '<div class="alert alert-danger" role="alert">Your message could not be sent, please try again later.</div>';
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

    <title>Contact Form - PHP</title>
  </head>
  <body>
      <!-- HTML content -->
    <div class="container">
        <h1>Get in touch!</h1>
        <!-- Error div to display our error messages -->
        <div id="error"><?php echo $error.$successMessage; ?></div>
        <form method="post">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
          </div>
          <div class="form-group">
            <label for="content">What would you like to ask us?</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!--Custom JavaScript-->
    <script type="text/javascript">
        $("form").submit(function (e){
          
          var error = "";
          if ($("#email").val() == ""){
            error += "The email feild is required.<br>"
          }
          if ($("#subject").val() == ""){
            error += "The subject feild is required.<br>"
          }
          if ($("#content").val() == ""){
            error += "The content feild is required.<br>"
          }

          if (error != ""){
            $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');

            return false;

          } else{
            return true;
          }


        });
    </script>
  </body>
</html>