<?php
class Post {
    private $id;
    private $title;
    private $content;
    public function __construct($id, $title, $content) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }
}
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

    public function getAllPosts() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM post");
        $stmt->execute();
        $posts = [];

        while($row = $stmt->fetch()) {
            $posts[] = new Post ($row['id'], $row['title'], $row['contents']);
        } 
        return $posts;
        } catch (PDOException $e) {
            throw new Exception ("Error retrieving students:". $e->getMessage());
        }
    }

    public function getPost($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM post WHERE id = ?");
            $stmt->execute(['$id']);
            $row = $stmt->fetch();

            while ($row) {
                return new Post ($row['id'], $row['title'], $row['contents']);
            }
        } catch (PDOException $e) {
            throw new Exception ("Error retrieving students:". $e->getMessage());
        }
    }

    public function addPost(Post $post) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO post (title, contents) VALUES (?, ?)");
            $stmt->execute([$post->getTitle(), $post->getContent()]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception ("Error adding students:". $e->getMessage());
        }
    }
}//class
