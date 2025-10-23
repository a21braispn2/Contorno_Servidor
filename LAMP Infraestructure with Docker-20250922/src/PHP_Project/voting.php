<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Voting Form</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
        require_once "OperationsDB.php";
        require_once("Utils/Artist.php");
        require_once("Utils/Vote.php");

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data); 
            $data = htmlspecialchars($data); 
        return $data;
        
        }

        $vote = null;
        $successMessage = "";
        $errorMessage = "";
        $artistIdErr = $nameErr = $dniErr = "";

        try {
            $oper = new Operations();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                
                $dni = isset($_POST['dni']) ? test_input($_POST['dni']) : "";
                $name = isset($_POST['name']) ? test_input($_POST['name']) : "";
                $artistId = isset($_POST['artistId']) ? test_input($_POST['artistId']) : "";
   

                if (isset($_POST['delete'])) {
                    if (!empty($dni)) {
                        $oper->deleteStudent($dni);
                        $successMessage = "Student successfully removed.";
                    } else {
                        $errorMessage = "Error: Missing data to delete.";
                    }
                }

                elseif (isset($_POST['save_update'])) {
                    if (!empty($dni) && !empty($name) && !empty($surname) && !empty($age)) {
                        $vote = new Student($dni, $name, $artistId);
                        $oper->updateVote($vote);
                        $successMessage = "Vote successfully updated";
                        $vote = null;
                    } else {
                        $errorMessage = "You must complete all fields before updating.";
                    }
                }

                elseif (isset($_POST['update'])) {
                    $vote = $oper->getStudent($dni);
                }

                elseif (isset($_POST['add'])) {
                    if (empty($dni)) {
                        $dniErr = "The DNI is mandatory";
                    } elseif (strlen($dni) != 9) {
                        $dniErr = "The DNI format is not valid<br>";
                    }

                    if (empty($dni)) $dniErr = "Dni is required<br>";
                    if (empty($name)) $nameErr = "Name is required<br>";
                    if (empty($artistId)) $artistIdErr = "Artist is mandatory<br>";

                    if (empty($dniErr) && empty($nameErr) && empty($artistIdErr) && empty($ageErr)) {
                        $existing = $oper->getVote($dni);
                        if ($existing) {
                            $errorMessage = "There is already a vote with that DNI.";
                        } else {
                            $vote = new Vote($dni, $name, $artistId);
                            $oper->addVote($vote);
                            $successMessage = "Vote added successfully.";
                            $vote = null;
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

    <h1>Vote for your favourite artist</h1>

    <?php if ($successMessage): ?>
    <p style="color:green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
    <p style="color:red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>



    <div class="form-container">
        <h3 id="formTitle">Voting</h3>
        <form method="POST" action="voting.php">
            <label>Artist:</label>
            <select name="artists" id="artists">
                <?php
                    $artists = $oper->getAllArtists();
                    foreach ($artists as $a) {
                        echo "<tr>
                                <td>".htmlspecialchars($a->getName())."</td>
                                <td>".htmlspecialchars($a->getLastSong())."</td>
                                <td>".htmlspecialchars($oper->getNumberVotes($a->getId()))."</td>
                                
                            </tr>";
                    }
            ?>
            </select>
            <input type="text" name="artistId" value="<?php echo $vote ? $vote->getArtistId() : ''; ?>" required />
            <span style="color:red;"><?php echo $artistIdErr; ?></span>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $vote ? $vote->getVoterName() : ''; ?>" required />
            <span style="color:red;"><?php echo $nameErr; ?></span>

            <label>DNI:</label>
            <input type="text" name="dni" value="<?php echo $vote ? $vote->getVoterDni() : ''; ?>" required />
            <span style="color:red;"><?php echo $dniErr; ?></span>

            <button type="submit" name="" <?php echo $vote ? 'save_update' : 'add'; ?>"" class="btn-add">
                Vote
            </button>
        </form>
    </div>
</body>

</html>