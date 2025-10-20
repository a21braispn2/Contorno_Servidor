<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Dinamically</title>
</head>
<body>
    <?php
    $bebidas = [
        "cocacola" => ["text" => "Coca Cola", "precio" => 2.1],
        "pepsicola" => ["text" => "Pepsi Cola", "precio" => 2],
        "fantanaranja" => ["text" => "Fanta Naranja", "precio" => 2.5],
        "trinamanzana" => ["text" => "Trina Manzana", "precio" => 2.3],
    ];

    echo '<select name="opcion">';

    foreach ($bebidas as $key => $info) {
        echo '<option value="' . $key . '">'
            . $info["text"] . " (" . $info["precio"] . " €)"
            . '</option>';
    }
        

    echo '</select>';
?>

    
</body>
</html>