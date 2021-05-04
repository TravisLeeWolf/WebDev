<?php

  $weather = "";
  $error = "";

  if ($_GET['city']){

    $urlContents = file_get_contents("api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=a2ef30ffa2ed4f82ce9096dbd80467d9");
    // urlencode() takes a string and adds code for characters like space and so on
    $weatherArray = json_decode($urlContents, true);
    
    // Check if valid city
    if ($weatherArray['cod'] == 200){
        // Get the weather description
        $weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description']." .";

        // Get the temperature
        $tempInCelcius = number_format(($weatherArray['main']['temp'] - 273), 1);
        $weather .= " The temperature is ".$tempInCelcius."&deg;C";

        // Get the wind speed
        $windSpeed = $weatherArray['wind']['speed'];
        $weather .= " and the wind speed is ".$windSpeed." m/s.";
    } else{
        $error = "Could not find city, please try again.";
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

    <title>Weather Scrapper</title>

    <!--CSS here-->
    <style type="text/css">
        html{
            background: url(weather.jpg) no-repeat center center fixed; 
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
            margin-top: 150px;
            width: 500px;
        }
        input{
          margin: 20px 0;
        }
        #weather{
          margin-top: 20px;
        }
    </style>
  </head>
  <body>
      <!-- HTML content -->
    <div class="container">
        <h1>What's the weather?</h1>
        <form>
            <div class="form-group">
              <label for="city">Enter the name of a city.</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="Eg. California, Hiroshima" value="<?php if(array_key_exists('city',$_GET)){echo $_GET['city'];}?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <div id="weather">
            <?php
              if ($weather){
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
              }
              if ($error){
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
              }
            ?>
          </div>
    </div>


    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>