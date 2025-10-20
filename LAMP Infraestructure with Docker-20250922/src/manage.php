<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Manage</title>
</head>

<body>
    <?php
    $subjects = [
        0 => "Java Programming",
        1 => "Web Design",
        2 => "Dockers administration",
        3 => "Django framework",
        4 => "Mongo database"
    ];

    $name = htmlspecialchars($_POST["name"]);
    $subjectValue = $_POST["subject"];

    if (!empty($name) && isset($subjects[$subjectValue])) {
        echo "<p>$name wants to enrol in the following subject: " . $subjects[$subjectValue];

        if (isset($_POST["mode"])) {
            $mode = htmlspecialchars($_POST["mode"]);
            echo " and $mode classes.";
        }

        echo "</p>";
    } else {
        echo "<p>Error: missing data.</p>";
    }
    ?>

    <p><a href="manage2.php?name=<?= urlencode($name) ?>&subject=<?= urlencode($subjectValue) ?>">Go to manage2.php</a>
    </p>
</body>

</html>