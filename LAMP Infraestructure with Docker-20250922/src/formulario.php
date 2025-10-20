<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>First practice using forms</title>
</head>

<body>
    <h1>First practice using forms.</h1>

    <?php
    $subjects = [
        0 => "Java Programming",
        1 => "Web Design",
        2 => "Dockers administration",
        3 => "Django framework",
        4 => "Mongo database"
    ];
    ?>

    <form action="manage.php" method="post">
        <label for="name">Name and surnames:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="subject">Subject to enroll:</label>
        <select id="subject" name="subject" required>
            <option value="">Select option</option>
            <?php foreach ($subjects as $value => $label): ?>
            <option value="<?= htmlspecialchars($value) ?>">
                <?= htmlspecialchars($label) ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Send data">
    </form>
</body>

</html>