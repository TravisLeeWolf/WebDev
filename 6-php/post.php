<?php
    // Using POST allows us to keep the imput data out of the website URL which adds a layer of security
    if ($_POST){
        $members = array("Tim", "Tammy", "Tom", "Terry", "Tabatha");
        $isKnown = false;
        foreach ($members as $value){
            if ($value == $_POST['name']){
                $isKnown = true;
            }
        }

        if ($isKnown){
            echo "Hi there ".$_POST['name']."!";
        } else{
            echo "I don't even know who you are.";
        }
    }

?>

<!--HTML here-->
<h3>PHP - POST function</h3>
<p>Using PHP to check if a name matches the defined list and printing a message response.</p>
<form method="post">
    <p>What is your name?</p>
    <p><input type="text" name="name"></p>
    <p><input type="submit" value="Submit"></p>
</form>