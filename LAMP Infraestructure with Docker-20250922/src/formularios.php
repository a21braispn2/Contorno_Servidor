<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $array = [
            "Java Programing","Web Design", "Docker Administration","Django Framework", "Mongo Database"
        ];

        $username = $subject = $usernameErr = '';
        
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
</body>

</html>