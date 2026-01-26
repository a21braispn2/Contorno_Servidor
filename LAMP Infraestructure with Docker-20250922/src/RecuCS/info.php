<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$aproba = test_input($_GET['aproba'])
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
</head>

<body>
    <h1>Aproba?</h1>
    <h2>
        <?php

        if ($aproba) {
            echo 'Si';
        } else {
            echo 'No';
        };

        ?>
    </h2>
    <a href="index.php"><button>Volver</button></aZ>
</body>

</html>