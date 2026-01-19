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
        require_once('Operations.php');
        require_once('Post.php');
        $oper = new Operations();
        $oper->openConnection();

        $posts = $oper->getAllPosts();
        foreach ($posts as $post) {
            echo '<li>'. htmlspecialchars($post->getTitle()).' <a href="modifyPost.php?id='.urlencode($post->getId()).'">Modify</a>' .'</li>';
        }
    ?>
    </ul>
</body>
</html>
