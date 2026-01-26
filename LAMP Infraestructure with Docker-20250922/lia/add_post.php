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
if(isset($_POST['action'])) {
    try {
    $message = '';
    $posts = [];

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        $title = test_input($_POST['title']);
        $content = test_input($_POST['content']);

        if ($action === 'add') {
            $post = new Post (null, $title, $content);
            $count = $db->addPost($post);
        }
    }
} catch (PDOException $e) {
    throw new Exception("Error:". $e->getMessage());
}
    header("Location: index.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a post</title>
</head>
<body>
    <h1>ADD A POST</h1>
    <form method="post" action="">
        Title: <input type="text" name="title" required> <br>
        Content: <input type="text" name="content" required> <br>
        <button onclick="index.php" type="submit" name="action" value="add" >Add to the database</button>
    </form>
</body>
</html>