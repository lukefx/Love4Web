<?php

/**
 * Dispacher for 404 Error Page not found
 * This dispacher il called volontary when you made an invalid request
 * it's my personal implementation of mod_rewrite
 * 
 * for example for change the language use this url:
 * http://www.lukefx.com/lang/it
 * 
 * /lang/it doesn't exist but the dispacher parse it and set language to italian
 * 
 */

include("common.php");

$session = new Session();
$config = Configuration::getInstance();
$request = explode("/", $_SERVER['REQUEST_URI']);

/*
echo "<pre>";
print_r($request);
echo "</pre>";
die();
*/

if(!strcasecmp($request[2], "admin"))
{
	$absPath = $config->absPath . "admin.php";
	header("location: " . $absPath);
	exit();
}

/**
 * Find if it's a language set calls
 * 
 */
if($key = array_search("lang", $request))
{
    $_SESSION['lang'] = $request[$key+1];	
}

/**
 * Move back to the previous page, if exists...
 * otherwise go back to index :-)
 */
if(!empty($_SERVER['HTTP_REFERER']))
{
	header("location:" . $_SERVER['HTTP_REFERER']);	
}
else
{
	$absPath = $config->absPath . "index.php";
	header("location: " . $absPath);	
}


?>