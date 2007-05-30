<?php
session_start();

$request = explode("/", $_SERVER['REQUEST_URI']);

if($key = array_search("lang", $request))
    $_SESSION['lang'] = $request[$key+1];

if(!empty($_SERVER['HTTP_REFERER']))
	header("location:".$_SERVER['HTTP_REFERER']);
else
	header("location: /love4web/index.php");

?>