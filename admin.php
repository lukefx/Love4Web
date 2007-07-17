<?php

include("common.php");
$session = new Session(true);

//TODO write code to handle user privilege!

$website = new love4web();
$website->templateAssign("version", love4web::getVersion());

$website->addTemplate("admin.tpl");
$website->run();

?>
