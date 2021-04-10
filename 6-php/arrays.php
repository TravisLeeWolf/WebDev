<?php
    $myArray = array("Bob", "Mary", "Tom", "Sarah");
    print_r($myArray);
    echo "<br>";
    echo $myArray[1];
    echo "<br>";

    // PHP arrays are associative so you can do things like this
    $foodArray[0] = "pizza";
    $foodArray[1] = "hamburger";
    $foodArray[5] = "tea";
    $foodArray["myFavouritefood"] = "Sushi";
    print_r($foodArray);
    echo "<br>";

    $anotherArray = array(
        "France" => "French",
        "UK" => "English",
        "Korea" => "Korean"
    );
    print_r ($anotherArray);
    echo "<br>";

    // Unset is used to remove an item from an array by it's id
    unset($anotherArray["France"]);
    print_r($anotherArray);
    
    // To get the size of an array we use sizeof()
    echo "<br>";
    echo "The size of this array is ".sizeof($anotherArray);
?>