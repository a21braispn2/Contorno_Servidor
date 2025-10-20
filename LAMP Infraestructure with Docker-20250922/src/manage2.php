<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Manage 2</title>
</head>

<body>
    <h2>Second step</h2>

    <?php
    $subjects = [
        0 => "Java Programming",
        1 => "Web Design",
        2 => "Dockers administration",
        3 => "Django framework",
        4 => "Mongo database"
    ];

    $name = isset($_GET["name"]) ? htmlspecialchars($_GET["name"]) : "";
    $subjectValue = isset($_GET["subject"]) ? $_GET["subject"] : "";
    ?>

    <form action="manage.php" method="post">
        <label for="name">Name and surnames:</label>
        <input type="text" id="name" name="name" value="<?= $name ?>" required><br><br>

        <label for="subject">Subject to enroll:</label>
        <select id="subject" name="subject" required>
            <option value="">Select option</option>
            <?php foreach ($subjects as $value => $label): ?>
            <option value="<?= htmlspecialchars($value) ?>" <?= $subjectValue == $value ? "selected" : "" ?>>
                <?= htmlspecialchars($label) ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Mode:</label><br>
        <input type="radio" name="mode" value="In-person" required> In-person classes <br>
        <input type="radio" name="mode" value="Distance" required> Distance classes <br><br>

        <input type="submit" value="Send data">
    </form>
</body>

</html>