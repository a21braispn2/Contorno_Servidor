<?php
require_once "Operations.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$alumno = null;
$successMessage = "";
$errorMessage = "";
$nomeErr = $apelidoErr = $dniErr = $ageErr = "";

try {
    $oper = new Operations();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $nome = isset($_POST['nome']) ? test_input($_POST['nome']) : "";
        $apelido = isset($_POST['apelido']) ? test_input($_POST['apelido']) : "";
        $surname = isset($_POST['surname']) ? test_input($_POST['surname']) : "";
        $age = isset($_POST['age']) ? test_input($_POST['age']) : "";

        if (isset($_POST['add'])) {
            if (!empty($dni)) {
                $oper->deleteStudent($dni);
                $successMessage = "Student successfully removed.";
            } else {
                $errorMessage = "Error: Missing data to delete.";
            }
        } elseif (isset($_POST['save_update'])) {
            if (!empty($dni) && !empty($name) && !empty($surname) && !empty($age)) {
                $student = new Student($dni, $name, $surname, $age);
                $oper->updateStudent($student);
                $successMessage = "Student successfully updated";
                $student = null;
            } else {
                $errorMessage = "You must complete all fields before updating.";
            }
        } elseif (isset($_POST['update'])) {
            $student = $oper->getStudent($dni);
        } elseif (isset($_POST['add'])) {
            if (empty($dni)) {
                $dniErr = "The DNI is mandatory";
            } elseif (strlen($dni) != 9) {
                $dniErr = "The DNI format is not valid<br>";
            }

            if (empty($name)) $nameErr = "Name is required<br>";
            if (empty($surname)) $surnameErr = "Surname is required<br>";
            if (empty($age)) $ageErr = "Age is mandatory<br>";

            if (empty($dniErr) && empty($nameErr) && empty($surnameErr) && empty($ageErr)) {
                $existing = $oper->getStudent($dni);
                if ($existing) {
                    $errorMessage = "There is already a student with that ID.";
                } else {
                    $student = new Student($dni, $name, $surname, $age);
                    $oper->addStudent($student);
                    $successMessage = "Student added successfully.";
                    $student = null;
                }
            } else {
                $errorMessage = "Please correct the errors before continuing..";
            }
        }
    }
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <h1>Alumnos</h1>
    <ul>
        <?php

        try {

            foreach ($alumnos as $alumno) {
                echo '<li><a href="info.php?aproba=' . urlencode($alumno->getAproba() ?? '') . '">' . urlencode($alumno->getNome()) . '</a></li>';
            }
        } catch (\Throwable $th) {
            echo 'Error - ' . $th;
        }

        ?>
    </ul>
    <a href="form.php"><button name="add">Añadir</button></a>
</body>

</html>