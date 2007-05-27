<?php
session_start();

$request = explode("/", $_SERVER['REQUEST_URI']);

switch($request[1])
{
	case "it":
		$_SESSION['lang'] = "it";
		break;
	case "en":
		$_SESSION['lang'] = "en";
		break;
	default:
		$_SESSION['lang'] = "en";
		break;
}

if(!empty($_SERVER['HTTP_REFERER']))
	header("location:".$_SERVER['HTTP_REFERER']);
else
	header("location:index.php");

?>