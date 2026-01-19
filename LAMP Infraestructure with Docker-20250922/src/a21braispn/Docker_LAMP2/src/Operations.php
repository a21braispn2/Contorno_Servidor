<?php
require_once("Post.php");
class Operations
{
    private $conn;
    public function __construct(){
        $this->openConnection();
    }
    public function openConnection()
    {
        // Database configuration (match your docker-compose.yml)
        $host = 'db';          // The service name in docker-compose (not 'localhost')
        $db   = 'mydb';        // Database name
        $user = 'user';        // MySQL username
        $pass = 'userpass';    // MySQL password
        $charset = 'utf8mb4';

        // DSN (Data Source Name)
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // PDO options for better error handling and performance
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
        ];

        // Create a PDO instance (connect to the database)
        $this->conn = new PDO($dsn, $user, $pass, $options);
    }//openConnection
    public function closeConnection()
    {
        $this->conn = null;
    }
    public function getAllPosts(){
        try {
            $query = $this->conn->query("SELECT id, title, contents FROM post");
            $posts = [];

            while ($row = $query->fetch()){
                $post = new Post();
                $id = $post->setId($row['id']);
                $title = $post->setTitle($row['title']);
                $contents = $post->setContents($row['contents']);
                $posts[] = $post;  
            }
            return $posts;
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw $e;
        }

    }

    public function getPost($id){
        try {
            $query = $this->conn->prepare("SELECT id, title, contents FROM post WHERE id = ?");
            $query->execute([$id]);
            $data = $query->fetch();

            if(!$data)return null;

            $post = new Post();
            $post->setId($data['id']);
            $post->setTitle($data['title']);
            $post->setContents($data['contents']);

            return $post;

        } catch (PDOException $e) {
            $this->conn->rollback();
            throw $e;
        }


    }

    public function modifyPost(Post $post){
        try {
            $this->conn->beginTransaction();
            $query = $this->conn->prepare("UPDATE post SET title = ?,contents = ? WHERE id = ?");
            $query->execute([
                $post->getTitle(),
                $post->getContents(),
                $post->getId()
            ]);
            $this->conn->commit();

        } catch (PDOException $e) {
            $this->conn->rollback();
            throw $e;
        }

    }

}//class
