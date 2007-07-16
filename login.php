<?php

include("common.php");

if(isset($_POST) && !empty($_POST))
{	
	
	/*
	echo "<pre>";
	print_r($_POST);	
	echo "</pre>";
	*/
	
	$session = new Session();
	$login = new DBLogin(new User($_POST['Username'], $_POST['Password']));
	
	if($login->login())
	    $session->logged();
	throw new Exception("Login error");
	exit();
}

$website = new love4web();
$website->addTemplate("login.tpl");
$website->run();

?>