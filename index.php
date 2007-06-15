<?php

include("common.php");

$website = new love4web();
$db = Persistent::getInstance();
$news = $db->collect("news", 0, 2);
$website->addTemplate("index.tpl");
$website->templateAssign("news", $news);
$website->run();

?>