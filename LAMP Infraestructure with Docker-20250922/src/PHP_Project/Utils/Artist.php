<?php
class Artist {
    private $id;
    private $name;
    private $lastSong;

    public function __construct($id = null, $name = null, $lastSong = null) {
        $this->id = $id;
        $this->name = $name;
        $this->lastSong = $lastSong;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
            return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
            $this->id = $id;

            return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
            return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
            $this->name = $name;

            return $this;
    }

    /**
     * Get the value of lastSong
     */
    public function getLastSong()
    {
            return $this->lastSong;
    }

    /**
     * Set the value of lastSong
     */
    public function setLastSong($lastSong): self
    {
            $this->lastSong = $lastSong;

            return $this;
    }

}
?>