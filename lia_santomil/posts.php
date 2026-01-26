<?php
require_once("Operations.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$db = new Operations();
$db->openConnection();

$title = test_input($_GET['title']);
$content = test_input($_GET['content']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <h1>
        <?php
            echo $title;
        ?>
    </h1>
    <p>
        <?php
            echo $content;
        ?>
    </p>
</body>
</html>