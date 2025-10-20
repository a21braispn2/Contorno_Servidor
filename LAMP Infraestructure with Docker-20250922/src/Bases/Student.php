<?php
class Student {
    private $dni;
    private $name;
    private $surname;
    private $age;

    public function __construct($dni = null, $name = null, $surname = null, $age = null) {
        $this->dni = $dni;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
    }

    // Getters
    public function getDni() {
        return $this->dni;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getAge() {
        return $this->age;
    }

    // Setters
    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function __toString() {
        return "DNI: $this->dni, Nombre: $this->name, Apellido: $this->surname, Edad: $this->age";
    }
}
?>