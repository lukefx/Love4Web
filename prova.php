<?php

include("common.php");

$session = new Session(true);
$website = new love4web();
$website->addTemplate("prova.tpl");
$website->run();

?>