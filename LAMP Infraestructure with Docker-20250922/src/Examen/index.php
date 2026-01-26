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
        require_once("Operations.php");
        require_once("Post.php");
        try {
            $oper = new Operations();
            $posts = $oper->getAllPosts();
            foreach ($posts as $post) {
                echo '<li><a href="#">' . htmlspecialchars($post->getTitle()) . '</a></li>';
            }
        } catch (\Throwable $th) {
            echo 'Error - ' . $th;
        }
        ?>
    </ul>
    <a href="form.php"><button type="button">Add a New Post</button></a>
</body>

</html>