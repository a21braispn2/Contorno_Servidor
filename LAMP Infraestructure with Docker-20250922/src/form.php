<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebidas</title>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>
    <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $units = "";
        $nameErr = "";
        $selectedDrink = "";

        $bebidas = [
            "cocacola"     => ["text" => "Coca Cola", "precio" => 2.1],
            "pepsicola"    => ["text" => "Pepsi Cola", "precio" => 2],
            "fantanaranja" => ["text" => "Fanta Naranja", "precio" => 2.5],
            "trinamanzana" => ["text" => "Trina Manzana", "precio" => 2.3],
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["units"])) {
                $nameErr = "Units are required";
            } else {
                $units = test_input($_POST["units"]);
            }

            if (!empty($_POST["opcion"])) {
                $selectedDrink = $_POST["opcion"];
            }
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="opcion">Choose a drink:</label>
        <select name="opcion" id="opcion">
            <?php
                foreach ($bebidas as $key => $info) {
                    $selected = ($key == $selectedDrink) ? "selected" : "";
                    echo '<option value="' . $key . '" ' . $selected . '>'
                        . $info["text"] . " (" . $info["precio"] . " €)"
                        . '</option>';
                }
            ?>
        </select>
        <br><br>

        Units: <input type="text" name="units" value="<?php echo $units; ?>">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr)) {
            $precio = $bebidas[$selectedDrink]["precio"] * $units;
            echo "<h3>You have asked for  $units bottle(s) of " . $bebidas[$selectedDrink]["text"] . "</h3>";
            echo "<p>Total price to pay: " . number_format($precio, 2) . " euros</p>";
        }
    ?>
</body>

</html>