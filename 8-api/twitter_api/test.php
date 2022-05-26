<?php

    // Getting twitteroauth 
    require "vendor/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    // Keys and Tokens
    $consumerKey = "consumerKey";
    $secretKey = "secretKey";
    $accessToken = "accessToken";
    $secretToken = "secretToken";

    // Connect to API
    $connection = new TwitterOAuth($consumerKey, $secretKey, $accessToken, $secretToken);
    $content = $connection->get("account/verify_credentials");

    print_r($content);
    
?>