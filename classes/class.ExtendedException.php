<?php

class ExtendedException extends Exception
{
    private $error;

    function ExtendedException($error)
    {
        $this->error = $error;
    }

    function showException($error)
    {
        echo "<h2>Uncought Exception:</h2>";
        echo "<pre>" . $this->getTraceAsString() . "</pre>";
        echo "<br /><small>Framework halted to prevent damages.</small>";
    }

}

?>