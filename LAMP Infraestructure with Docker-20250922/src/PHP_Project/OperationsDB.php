<?php
require_once("Artist.php");
require_once("Vote.php");

class Operations {
    private $conn;

    public function __construct() {
        $this->openConnection();
    }

    private function openConnection() {
        $host = 'db';
        $db   = 'Urban Music Awards';
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

    public function closeConnection() {
        $this->conn = null;
    }

    public function getArtist($name) {
        $stmt = $this->conn->prepare("SELECT artist_id, name, last_song FROM Artists WHERE name = ?");
        $stmt->execute([$name]);
        $data = $stmt->fetch();

        if (!$data) return null;

        $artist = new Artist();
        $artist->setId($row["id"]);
        $artist->setName($row["name"]);
        $artist->setLastSong($row["lastSong"]);
        return $artist;
    }

    public function getAllArtists() {
        $stmt = $this->conn->query("SELECT artist_id, name, last_song FROM Artists");
        $artists = [];

        while ($row = $stmt->fetch()) {
            $artist = new Artist();
            $artist->setId($row["id"]);
            $artist->setName($row["name"]);
            $artist->setLastSong($row["lastSong"]);
            $artists[] = $artist;
        }

        return $artists;
    }

    public function addrtist(artist $artist) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare(
                "INSERT INTO artist (dni, name, surname, age) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([
                $artist->getDni(),
                $artist->getName(),
                $artist->getSurname(),
                $artist->getAge()
            ]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error adding artist: " . $e->getMessage());
        }
    }

    public function updateartist(artist $artist) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare(
                "UPDATE artist SET name = ?, surname = ?, age = ? WHERE dni = ?"
            );
            $stmt->execute([
                $artist->getName(),
                $artist->getSurname(),
                $artist->getAge(),
                $artist->getDni()
            ]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error updating artist: " . $e->getMessage());
        }
    }

    public function deleteartist($dni) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM artist WHERE dni = ?");
            $stmt->execute([$dni]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error deleting artist: " . $e->getMessage());
        }
    }
}
?>