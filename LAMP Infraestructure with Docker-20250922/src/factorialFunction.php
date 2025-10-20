<?php
    function factorial($num){
        if ($num < 0) {
            throw new Exception("Non pode ser menor a 0");
        }
        if (!is_int($num)){
            throw new TypeError("Debe ser un numero");
        }
        if ($num == 0){
            return 0;
        }
        $resultado = 1;
        $cont = 1;
        while ($cont <= $num) {
            $resultado *= $cont; 
            $cont++;
        }
        return $resultado;
    }
    define("NUMERO", 5)
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
            echo "<p>Resultado bueno 5! = " . factorial(NUMERO) . "</p>";;
            echo "<p>Resultado bueno 0! = " . factorial(0) . "</p>";;
            echo "<p>Resultado bueno -1! = " . factorial(-1) . "</p>";;
        } catch (TypeError $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        } catch (Exception $e){
            echo "<p>Error: " . $e->getMessage() . "</p>";

        }
    ?>
</body>
</html>