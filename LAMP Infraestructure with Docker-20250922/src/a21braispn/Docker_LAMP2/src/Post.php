<?php
class Post {
    private $id;
    private $title;
    private $contents;

    public function __construct($id = null, $title = null, $contents = null){
        $this->id = $id;
        $this->title = $title;
        $this->contents = $contents;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getContents()
    {
        return $this->contents;
    }


    public function setContents($contents): self
    {
        $this->contents = $contents;

        return $this;
    }
}

?>