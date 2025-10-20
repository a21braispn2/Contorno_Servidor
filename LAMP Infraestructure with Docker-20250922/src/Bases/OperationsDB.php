<?php
require_once("Student.php");

class Operations {
    private $conn;

    public function __construct() {
        $this->openConnection();
    }

    private function openConnection() {
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

    public function closeConnection() {
        $this->conn = null;
    }

    public function getStudent($dni) {
        $stmt = $this->conn->prepare("SELECT dni, name, surname, age FROM student WHERE dni = ?");
        $stmt->execute([$dni]);
        $data = $stmt->fetch();

        if (!$data) return null;

        $student = new Student();
        $student->setDni($data["dni"]);
        $student->setName($data["name"]);
        $student->setSurname($data["surname"]);
        $student->setAge($data["age"]);
        return $student;
    }

    public function getAllStudents() {
        $stmt = $this->conn->query("SELECT dni, name, surname, age FROM student");
        $students = [];

        while ($row = $stmt->fetch()) {
            $student = new Student();
            $student->setDni($row["dni"]);
            $student->setName($row["name"]);
            $student->setSurname($row["surname"]);
            $student->setAge($row["age"]);
            $students[] = $student;
        }

        return $students;
    }

    public function addStudent(Student $student) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare(
                "INSERT INTO student (dni, name, surname, age) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([
                $student->getDni(),
                $student->getName(),
                $student->getSurname(),
                $student->getAge()
            ]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error adding student: " . $e->getMessage());
        }
    }

    public function updateStudent(Student $student) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare(
                "UPDATE student SET name = ?, surname = ?, age = ? WHERE dni = ?"
            );
            $stmt->execute([
                $student->getName(),
                $student->getSurname(),
                $student->getAge(),
                $student->getDni()
            ]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error updating student: " . $e->getMessage());
        }
    }

    public function deleteStudent($dni) {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM student WHERE dni = ?");
            $stmt->execute([$dni]);
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error deleting student: " . $e->getMessage());
        }
    }
}
?>