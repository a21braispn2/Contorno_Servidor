<?php
    require_once('Operations.php');
    require_once('Post.php');

    $oper = new Operations();
    $oper->openConnection();

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $titleErr = $contentsErr = $modifyErr = "";
    $title = $contents = $modify = "";
    $id = $_GET["id"];

    $oldPost = $oper->getPost($id);
    $title2 = $oldPost->getTitle();
    $contents2 = $oldPost->getContents();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["title"])) {
            $titleErr = "Title is required";
        } else {
            $title = test_input($_POST["title"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$title)) {
                $titleErr = "Only letters and white space allowed";
            }
        }
        
        if (empty($_POST["contents"])) {
            $contentsErr = "Contents is required";
        } else {
            $contents = test_input($_POST["contents"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$contents)) {
                $contentsErr = "Only letters and white space allowed";
            }
        }
            

        if (isset($_POST["modify"])) {
            $post = new Post();
            $post->setId($id);
            $post->setTitle($title);
            $post->setContents($contents);
            $oper->modifyPost($post);
            $title2 = $title;
            $contents2 = $contents;
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Post</title>
    <style>
        input{
            width: 300px;
        }
    </style>
</head>
<body>
    <h1>MODIFY THE POST</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>" method="post">
        <label for="title">Title:</label><br>
        <input type="text" name="title" value="<?php echo $title2;?>" required>
        <br><br>
        <label for="contents">Contents:</label><br>
        <input type="text" name="contents"  value="<?php echo $contents2;?>" required>
        <br><br>
        <button type="submit" name="modify">Modify</button>
    </form>
        <br>
        <a href="index.php"><button>Volver</button></a>

</body>
</html>