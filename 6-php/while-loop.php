<?php

$i = 0;

while ($i <= 10){
    echo $i."<br>";
    $i++;
}

echo "<br>";

$food = array("Pizza", "Sushi", "Steak", "Hamburger");
$i = 0;
while ($i < sizeof($food)){
    echo $food[$i]."<br>";
    $i++;
}

?>