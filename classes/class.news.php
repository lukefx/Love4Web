<?php

class news {

    var $title;
    var $text;
    var $author;
    var $category;

    function news($title="", $text="", $author="", $category="")
    {
        $this->title = $title;
        $this->text = $text;
        $this->author = $author;
        $this->category = $category;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setText($text)
    {
        $this->text = $text;
    }

    function setAuthor($author)
    {
        $this->author = $author;
    }

    function setCategory($category)
    {
        $this->category = $category;
    }
    
}

?>