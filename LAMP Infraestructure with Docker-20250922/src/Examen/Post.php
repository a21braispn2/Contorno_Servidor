<?php
class Post
{
    private $title;
    private $contents;

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }



    /**
     * Get the value of contents
     */ 
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Set the value of contents
     *
     * @return  self
     */ 
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }
}
?>