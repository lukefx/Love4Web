<?php

session_start();

// funzione di debugging
function dump($array) {
	echo "<PRE>";
	print_r($array);
	echo "</PRE>";
}

include_once("libs/SmartyML.class.php");

if ($dh = opendir("classes"))
{
    while (($file = readdir($dh)) !== false)
    {
        if (preg_match("/class\.([a-zA-Z0-9]+).php/", $file, $matches) > 0)
        {
            require_once("classes/".$file);
        }
    }
}
else
{
    die("Fatal Error: class folder not found.");
}

?>
