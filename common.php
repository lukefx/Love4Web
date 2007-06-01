<?php

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
    die("Class folder not found");
}

$session = new Session();


?>
