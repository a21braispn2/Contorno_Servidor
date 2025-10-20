<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARRAYS</title>
</head>
<body>
    <h1>ARRAYS</h1>
    <?php
    //Indexed arrays
    $cars = array("Volvo", "BMW", "Toyota");
    $cars1 = ["Volvo", "BMW", "Toyota"];
    echo "<h4>ARRAY CARS</h4>";
    foreach ($cars1 as $car)
        echo $car."-";

    echo "<br>Position 2 of cars: ".$cars[1];

    //Associative arrays
    $ages = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    echo "Peter is " . $ages['Peter'] . " years old.";
    foreach($ages as $key => $value) {
        echo "Key=" . $key . ", Value=" . $value;
        echo "<br>";
    }

    //Multidimensional Arrays
    $mcars = array(
        array("Volvo", 1500, 4),
        array("BMW", 1000, 6),
        array("Saab", 2000, 8)
    );
    foreach($mcars as $unArray){
        echo "<br>CAR: ";
        foreach($unArray as $campo)
            echo $campo." ";
    }
    $mcars1 = [
       ["Volvo",22,18],
       ["BMW",15,13]
    ];

    //Multidimensional key-value Arrays
    $mcarsKeyValue = array(
        "First" => array("Model"=>"Volvo", "Model"=>1500, "number"=>4),
        "Second" => array("Model"=>"BMW", "Model"=>1000, "number"=>6),
        "Third" => array("Model"=>"Saab", "Model"=>2000, "number"=>8)
    );

    foreach($mcarsKeyValue as $key => $valueArray) {
        echo "<br><br>Key=" . $key . ", Value=";
        foreach($valueArray as $key2 => $value2) {
            echo "Key=" . $key2 . ", Value=".$value2;
        }
        echo "<br>";
    }

    //Initialize an empty array
    $fruits = []; //$fruits = array(); This second way is also valid
    //Add elements to an array
    $fruits[] = "Orange";
    array_push($fruits, "Kiwi", "Lemon");
    echo "<br><br>";
    foreach ($fruits as $fruit)
        echo $fruit." ";

    ?>
</body>
</html>