<?php
require_once('Operations.php');
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <h1>Añade un alumno</h1>
    <form method="post" action="index.php">
        Nome: <input type="text" name="nome" required> <br>
        Apelido: <input type="text" name="apelido" required> <br>
        <button type="submit" value="add">Add to the database</button>
    </form>
</body>

</html>