<?php

include("common.php");

if(isset($_POST) && !empty($_POST))
{
    $session = new Session();

    /*

    // Google Authentication implementation
   	$buf = sprintf('accountType=GOOGLE&Email=%s&Passwd=%s&service=cl&source=%s',
 		rawurlencode($_POST['Email']),
  		rawurlencode($_POST['Passwd']),
  		rawurlencode('love4web-Lukefx-1.0'));

	$ch = curl_init('https://www.google.com/accounts/ClientLogin');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $buf);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($ch);
	preg_match('/auth=(.+)/i', $res, $m);
	$authcode = $m[1];
    echo $authcode;

    */

    $session->logged();
}

$website = new love4web();
$website->addTemplate("login.tpl");
$website->run();

?>