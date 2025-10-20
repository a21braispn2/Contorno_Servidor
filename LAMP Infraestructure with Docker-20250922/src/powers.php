<?php
        function power($num1,$num2 = 2){
            if (!is_int($num1) || !is_int($num2)) {
              return  "No es integer";
            }
            return $num1**$num2;
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
        echo "<p>Resultado bueno 2² = " .  power(2,2) . "</p>";
        echo "<p>Resultado bueno 3² = " .  power(3) . "</p>";
        echo "<p>Resultado malo 2.5² = " .  power(2.5,2) . "</p>";
    ?>
</body>
</html>