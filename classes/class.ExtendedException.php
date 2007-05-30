<?php

class ExtendedException extends Exception
{
    function ExtendedException($error)
    {
        echo "<h2>Uncought Exception:</h2>";
        echo "<pre>" . $this->getTraceAsString() . "</pre>";
        die();
    }
}

?>