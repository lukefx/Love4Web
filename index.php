<?php

include("common.php");

$website = new love4web();

$db = Persistent::getInstance();
// retreive some news...
//$db->setFirstResult(0);
//$db->setLastResult(2);
$news = $db->collect("news", 0, 2);

$website->addTemplate("index.tpl");
$website->templateAssign("news", $news);
$website->run();

?>