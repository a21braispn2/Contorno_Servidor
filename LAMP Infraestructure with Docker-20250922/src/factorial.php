<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $num = 1;
        $resultado = 5;
        while ($num < 5) {
            $resultado *= $num;
            $num++;
        }
        echo $resultado;
    ?>
</body>
</html>