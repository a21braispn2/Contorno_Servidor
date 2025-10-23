<?php
require_once("Utils/Artist.php");
require_once("Utils/Vote.php");

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
            $artist->setId($row["artist_id"]);
            $artist->setName($row["name"]);
            $artist->setLastSong($row["last_song"]);
            $artists[] = $artist;
        }

        return $artists;
    }

    public function getVote($dni) {
        $stmt = $this->conn->prepare("SELECT voter_dni, voter_name, artist_id FROM Votes WHERE voter_dni = ?");
        $stmt->execute([$dni]);
        $data = $stmt->fetch();

        if (!$data) return null;

        $vote = new Artist();
        $vote->setVoterDni($row["voter_dni"]);
        $vote->setVoterName($row["voter_name"]);
        $vote->setArtistId($row["artist_id"]);
        return $vote;
    }
    public function getNumberVotes($artistId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM Votes WHERE artist_id = ?");
        $stmt->execute([$artistId]);
        $data = $stmt->fetch();

        if (!$data) return 0;

        return (int)$data['total'];
    }

    public function addVote(Vote $vote) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare(
                "INSERT INTO Votes (voter_dni, voter_name, artist_id) VALUES (?, ?, ?)"
            );
            $stmt->execute([
                $vote->setVoterDni(),
                $vote->getVoterName(),
                $vote->getArtistId(),
            ]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error adding vote: " . $e->getMessage());
        }
    }

    public function updateVote(Vote $vote) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare(
                "UPDATE Vote SET voterName = ?, artistId = ? WHERE voterDni = ?"
            );
            $stmt->execute([
                $vote->setVoterDni(),
                $vote->getVoterName(),
                $vote->getArtistId(),
            ]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error updating vote: " . $e->getMessage());
        }
    }

    public function deleteVote($voterDni) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM Vote WHERE voterDni = ?");
            $stmt->execute([$voterDni]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error deleting vote: " . $e->getMessage());
        }
    }
}
?>