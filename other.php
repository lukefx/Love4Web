<?php

include("common.php");

// Questa pagina richiede l'autenticazione
$session = new Session(true);

$website = new love4web();
$website->addTemplate("other.tpl");
$website->run();

?>