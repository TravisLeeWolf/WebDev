<?php

    // Getting twitteroauth 
    require "vendor/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    // Keys and Tokens
    $consumerKey = "rbv1z2vCFGzhM2CUdlWzbWrza";
    $secretKey = "xEBuegwSFlVGdCH6K5Msb73OY5qWk7BGFO7evVSnCOjqxwLhFd";
    $accessToken = "1357145898019479555-ZtVpxN19rUjB8l92hXSukAeRiMzyS7";
    $secretToken = "m82n62mz0EVmWdXH2g5oWmayHDz0HvzWQkZbBb0htBSVN";

    // Connect to API
    $connection = new TwitterOAuth($consumerKey, $secretKey, $accessToken, $secretToken);
    $content = $connection->get("account/verify_credentials");

    print_r($content);
    
?>