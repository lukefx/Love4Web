<?php

include_once("libs/SmartyML.class.php");

// Final Catch per le eccezioni che raggiungo la main page
function myException($exception)
{
    $website = new SmartyML($_SESSION['lang']);
    $website->assign("error", $exception->getMessage());
    $website->display("exception.tpl");
    exit();
}
set_exception_handler('myException');

/* Inclusione di tutto il framework */
if ($dh = @opendir("classes"))
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
    throw new Exception("Class folder not found");
}

?>
