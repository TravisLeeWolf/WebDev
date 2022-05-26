<?php

for ($i = 0; $i <= 10; $i++){
    echo $i."<br>";
}
echo "<br>";
$fruits = array("Mango", "Coconut", "Banana", "Strawberry", "Pineapple");
for ($i = 0; $i < sizeof($fruits); $i++){
    echo $fruits[$i]."<br>";
}

// Works like the above but easier
foreach ($fruits as $key => $value){
    echo "Array item ".$key." is ".$value."<br>";
}

?>