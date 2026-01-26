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
try {
    $message = '';
    $posts = [];

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        $id = test_input($_POST['id']);
        $title = test_input($_POST['title']);
        $content = test_input($_POST['contents']);

        if ($action === 'search') {
            $post = $db->getPost($id);
            if ($post) {
                $posts[] = $post;
                $message = "Post found!";
            } else {
                $message = "Post not found.";
            }
        }
    }

    if (!empty($message)) {
        echo "<p>{$message}</p>";
    }

    if(empty($posts)) {
        $posts = $db->getAllPosts();
    }
} catch (PDOException $e) {
    throw new Exception("Error:". $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>POSTS</h1>
    <ul>
        <?php
            foreach($posts as $p) {
                echo '<li> <a href="posts.php?&title='.urlencode($p->getTitle()).'&content='.urlencode($p->getContent()).'">'. $p->getTitle().'</a></li>';
            }
        ?>
    </ul>

    <a href="add_post.php">
        <button>Add new post</button>
    </a>
</body>
</html>