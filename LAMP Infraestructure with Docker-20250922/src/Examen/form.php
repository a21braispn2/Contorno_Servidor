<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
require_once("Operations.php");
require_once("Post.php");

$titleErr = $contentsErr = "";
$title = $contents = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["title"])) {
    $titleErr = "Title is required";
  } else {
    $title = test_input($_POST["title"]);
  }
  
  if (empty($_POST["contents"])) {
    $contentsErr = "Contents are required";
  } else {
    $contents = test_input($_POST["contents"]);
  }
  
  if (isset($_POST["add"])) {

    if (empty($titleErr) && empty($contentsErr)) {
        try {
            $open = new Operations();
            $post = new Post();
            $post->setTitle($title);
            $post->setContents($contents);
            $open->addPost($post);
        } catch (\Throwable $th) {
            echo 'Error - ' . $th;
        }
    }

  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>ADD A POST</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Title: <input type="text" name="title" value="<?php echo $title;?>">
  <span class="error">* <?php echo $titleErr;?></span>
  <br><br>
  Contents: <input type="text" name="contents" value="<?php echo $contents;?>">
  <span class="error">* <?php echo $contentsErr;?></span>
  <br><br>
  <input type="submit" name="add" value="Add to the database">  
</form>


</body>
</html>