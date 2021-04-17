<?php

    $emailTO = "example@client.com";
    $subject = "This is a test";
    $body = "This is working, wow!";
    $headers = "From: example@server.com";

    if (mail($emailTO, $subject, $body, $headers)){
        echo "Email sent successfully!";
    } else {
        echo "Did not send.";
    }

?>