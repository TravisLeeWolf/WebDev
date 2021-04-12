<?php

    // print_r($_GET); This GET is used for getting the information sent from the user

    // Finding if the input is a prime number or not
    if (is_numeric($_GET['number']) && $_GET['number'] > 0 && $_GET['number'] == round($_GET['number'],0)){
        $i = 2;
        $isPrime = true;
        while ($i < $_GET['number']){
            if ($_GET['number'] % $i == 0){
                // Number is not prime
                $isPrime = false;
            }
            $i++;
        }
        if ($isPrime){
            echo "<p>".$i." is a prime number!</p>";
        } else{
            echo "<p>".$i." is not a prime number.</p>";
        }
    } else if ($_GET){
        // Prompt user to enter correct value
        echo "<p>Please enter a positive whole number.<p>";
    }

?>

<p>Please enter a whole number</p>
<form>
    <input name="number" type="text">
    <input type="submit" value="Go!">
</form>