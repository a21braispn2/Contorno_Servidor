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
$artistErr = $nameErr = $dniErr = "";

try {
    $oper = new Operations();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $artist = isset($_POST['artists']) ? test_input($_POST['artists']) : "";
        $name   = isset($_POST['name']) ? test_input($_POST['name']) : "";
        $dni    = isset($_POST['dni']) ? test_input($_POST['dni']) : "";

        if (isset($_POST['add'])) {

            if (empty($artist)) $artistErr = "Artist is mandatory<br>";
            if (empty($name)) $nameErr = "Name is required<br>";
            if (empty($dni)) {
                $dniErr = "DNI is required<br>";
            } elseif (strlen($dni) != 9) {
                $dniErr = "The DNI format is not valid<br>";
            }

            if (empty($dniErr) && empty($nameErr) && empty($artistErr)) {

                setcookie("vote_artist", $artist, time() + (86400 * 30), "/");
                setcookie("vote_name", $name, time() + (86400 * 30), "/");
                setcookie("vote_dni", $dni, time() + (86400 * 30), "/");

                $existing = $oper->getVote($dni);
                if ($existing) {
                    $errorMessage = "There is already a vote with that DNI.";
                } else {
                    $vote = new Vote($dni, $name, $artist);
                    $oper->addVote($vote);
                    $successMessage = "Vote added successfully.";
                    $vote = null;
                }
            } else {
                $errorMessage = "Please correct the errors before continuing.";
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
    <meta charset="UTF-8" />
    <title>Voting Form</title>
    <link rel="stylesheet" href="Utils/voting.css">
</head>

<body>
    <header>
        <a href="index.php"><img src="Utils/icono.png" alt="icono"></a>

    </header>
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
                        $selected = (isset($_COOKIE['vote_artist']) && $_COOKIE['vote_artist'] == $a->getId()) ? "selected" : "";
                        echo "<option value=\"".$a->getId()."\" $selected>".$a->getName()."</option>";
                    }
                ?>
            </select>
            <span style="color:red;"><?php echo $artistErr; ?></span>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $_COOKIE['vote_name'] ?? ''; ?>" required />
            <span style="color:red;"><?php echo $nameErr; ?></span>

            <label>DNI:</label>
            <input type="text" name="dni" value="<?php echo $_COOKIE['vote_dni'] ?? ''; ?>" required />
            <span style="color:red;"><?php echo $dniErr; ?></span>

            <button type="submit" name="add" class="btn-add">Vote</button>
        </form>
    </div>
</body>

</html>