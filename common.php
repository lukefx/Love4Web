<?php

/**
 * This file the entryPoint of the Framework.
 * 
 */

include_once($config->absPath . "libs/SmartyML.class.php");

// Final Catch per le eccezioni che raggiungo la main page
function myException($exception)
{
    $website = new SmartyML($_SESSION['lang']);
	$config = Configuration::getInstance();
    $website->template_dir = $config->absPath . 'templates/';
    $website->compile_dir = $config->absPath . 'templates_c/';
    $website->config_dir = $config->absPath . 'configs/';
    $website->cache_dir = $config->absPath . 'cache/';
    $website->caching = true;
    $website->assign("error", $exception->getMessage());
    $website->display("exception.tpl");
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
