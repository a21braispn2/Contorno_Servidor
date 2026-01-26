<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
        require_once "OperationsDB.php";
        require_once "Student.php";

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data); 
            $data = htmlspecialchars($data); 
        return $data;
        }

        $student = null;
        $successMessage = "";
        $errorMessage = "";
        $nameErr = $surnameErr = $dniErr = $ageErr = "";

        try {
            $oper = new Operations();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                
                $dni = isset($_POST['dni']) ? test_input($_POST['dni']) : "";
                $name = isset($_POST['name']) ? test_input($_POST['name']) : "";
                $surname = isset($_POST['surname']) ? test_input($_POST['surname']) : "";
                $age = isset($_POST['age']) ? test_input($_POST['age']) : "";



                if (isset($_POST['update'])) {
                    $student = $oper->getStudent($dni);
                }

                elseif (isset($_POST['add'])) {
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

    <h1>List of Students</h1>

    <table id="studentsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>DNI</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentList">
            <?php
        try {
            $students = $oper->getAllStudents();
            foreach ($students as $s) {
                echo "<tr>
                        <td>".htmlspecialchars($s->getName())."</td>
                        <td>".htmlspecialchars($s->getSurname())."</td>
                        <td>".htmlspecialchars($s->getDni())."</td>
                        <td>".htmlspecialchars($s->getAge())."</td>
                        <td>
                            <form method='POST' action='studentManager.php'>
                                <input type='hidden' name='dni' value='".htmlspecialchars($s->getDni())."'>
                                <button type='submit' name='update' class='btn-update'>Update</button>
                                <button type='submit' name='delete' class='btn-delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='5' style='color:red;'>DB Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="form-container">
        <h3 id="formTitle"><?php echo $student ? "Update Student" : "Update Student"; ?></h3>
        <form method="POST" action="studentManager.php">
            <label>DNI:</label>
            <input type="text" name="dni" value="<?php echo $student ? $student->getDni() : ''; ?>" required />
            <span style="color:red;"><?php echo $dniErr; ?></span>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $student ? $student->getName() : ''; ?>" required />
            <span style="color:red;"><?php echo $nameErr; ?></span>

            <label>Surname:</label>
            <input type="text" name="surname" value="<?php echo $student ? $student->getSurname() : ''; ?>" required />
            <span style="color:red;"><?php echo $surnameErr; ?></span>

            <label>Age:</label>
            <input type="number" name="age" value="<?php echo $student ? $student->getAge() : ''; ?>" required />
            <span style="color:red;"><?php echo $ageErr; ?></span>

            <button type="submit" name="<?php echo $student ? 'save_update' : 'add'; ?>" class="btn-add">
                <?php echo $student ? 'Update' : 'Save'; ?>
            </button>
        </form>
    </div>
</body>

</html>