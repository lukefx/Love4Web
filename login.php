<?php

include("common.php");

if(isset($_POST) && !empty($_POST))
{	
	$session = new Session();
	$google = new GoogleLogin(new User($_POST['Email'], $_POST['password']));
	
	if($google->login())
	    $session->logged();	
}

$website = new love4web();
$website->addTemplate("login.tpl");
$website->run();

?>