<?php

include("common.php");

$website = new love4web();
$website->addTemplate("index.tpl");
//$website->run();


    $prova1 = new news("titolo", "testo", "autore", "categoria");
    $prova2 = new news("titolo", "testo", "autore", "categoria");
    $prova3 = new news("titoloz", "testoz", "autorez", "categoriaz");
    $prova4 = new news();

    $db = Persistent::getInstance();
    $db->store($prova1);
    $db->store($prova2);
    $db->store($prova3);
    $db->restore($prova4);

    echo "<br />";

    foreach ($prova4 as $nome => $valore) {
        echo "$nome : $valore<br />";
    }


?>