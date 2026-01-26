<?php

class Alumno
{
    private $id;
    private $nome;
    private $apelido;
    private $aproba;

    public function __construct($id = null, $nome = null, $apelido = null, $aproba = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->aproba = $aproba;
    }



    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }


    public function setApelido($apelido)
    {
        $this->apelido = $apelido;

        return $this;
    }
    public function getApelido()
    {
        return $this->apelido;
    }

    public function setAproba($aproba)
    {
        $this->aproba = $aproba;

        return $this;
    }
    public function getAproba()
    {
        return $this->aproba;
    }
}



class Operations
{
    private $conn;

    public function __construct()
    {
        $this->openConnection();
    }

    private function openConnection()
    {
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

    public function getAlumno($nome)
    {
        $query = $this->conn->prepare("SELECT id,nome,apellido,aproba FROM alumnos WHERE nome = ?");
        $query->execute([$nome]);
        $data = $query->fetch();

        if (!$data) return null;

        $alumno = new Alumno();
        $alumno->setId($data['id']);
        $alumno->setNome($data['nome']);
        $alumno->setApelido($data['apellido']);
        $alumno->setAproba($data['aproba']);


        return $alumno;
    }


    public function getAlumnos()
    {
        $query = $this->conn->query("SELECT id,nome,apellido,aproba FROM alumnos");
        $alumnos = [];


        while ($row = $query->fetch()) {
            $alumno = new Alumno();
            $alumno->setId($row["id"]);
            $alumno->setNome($row["nome"]);
            $alumno->setApelido($row["apellido"]);
            $alumno->setAproba($row["aproba"]);
            $alumnos[] = $alumno;
        }

        return $alumnos;
    }

    public function addAlumno(Alumno $alumno)
    {
        $this->conn->beginTransaction();
        $query = $this->conn->prepare("INSERT INTO alumnos(nome,apellido,aproba) VALUES (?,?,?)");
        $query->execute([$alumno->getNome(), $alumno->getApelido(), $alumno->getAproba()]);

        $this->conn->commit();
        return $query->rowCount();
    }
}
