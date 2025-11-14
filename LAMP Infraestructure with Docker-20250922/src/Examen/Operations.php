<?php
require_once("Post.php");

class Operations
{
    private $conn;

    public function __construct()
    {
        $this->openConnection();
    }

    public function openConnection()
    {
        // Configuración de la base de datos
        $host = 'db';
        $db   = 'mydb';
        $user = 'user';
        $pass = 'userpass';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->conn = new PDO($dsn, $user, $pass, $options);
    }

    public function closeConnection()
    {
        $this->conn = null;
    }

    public function getAllPosts()
    {
        $sqlString = 'SELECT title, contents FROM post';
        $query = $this->conn->prepare($sqlString);
        $query->execute();

        $posts = [];
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $post = new Post($row['title'], $row['contents']);
            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost($id)
    {
        $sqlString = 'SELECT title, contents FROM post WHERE id = ?';
        $query = $this->conn->prepare($sqlString);
        $query->execute([$id]);
        $data = $query->fetch();

        if ($data) {
            return new Post($data['title'], $data['contents']);
        } else {
            return null;
        }
    }

    public function addPost($post)
    {
        $sqlString = 'INSERT INTO post (title, contents) VALUES (?, ?)';
        $query = $this->conn->prepare($sqlString);
        $query->execute([$post->getTitle(), $post->getContents()]); 
    }
}
?>