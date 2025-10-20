<?php
    function printPerson(?string $name,int $age, string $surname = "Apelido"){
        if (!is_string($surname) || !is_int($age)) {
            throw new TypeError("Error de tipo de dato");
        }
        if ($age < 0) {
            throw new Exception("Non pode ter menos de 0 anos");
        }
        echo "<b>" . $name . " " . $surname . " is " . $age . " years old</b>";;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    try {
        printPerson("Brais",19,"Pose");
    } catch (TypeError $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    } catch (Exception $e){
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
        
    ?>
    
</body>
</html>