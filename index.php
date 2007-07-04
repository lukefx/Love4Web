<?php

include("common.php");

$session = new Session();
$website = new love4web();
$db = Persistent::getInstance();

// Store di alcune news
/*
$news_1 = new news("A proposito di...", "<p>Alcuni hanno tentato di definire il Web 2.0 come una serie di siti web con interfaccia, facilità e velocità d'uso tali da renderli simili alle applicazioni tradizionali che gli utenti sono abituati a installare nei propri personal computer. I propositori del termine Web 2.0 affermano che questo differisce dal concetto iniziale di web, retroattivamente etichettato Web 1.0, perché si discosta dai classici siti web statici, dall'e-mail, dall'uso dei motori di ricerca, dalla navigazione lineare e propone un World Wide Web più dinamico e interattivo.</p>
<p>Gli scettici replicano che il termine Web 2.0 non ha un vero e proprio significato, in quanto questo dipende esclusivamente da ciò che i propositori decidono che debba significare per cercare di convincere i media e gli investitori che stanno creando qualcosa di nuovo e migliore, invece di continuare a sviluppare le tecnologie esistenti.</p>
<p>Con questo stile mi piace studiare, progettare e creare piccole soluzioni web, Mashup e tutto quello che mi passa per la testa...</p>", "Luke", "Stile Libero");

$news_2 = new news("Amore per il web", "<p>Questo mio piccolo sito utilizza come cuore il mio piccolo Framework sviluppato nel corso degli anni. Dovendo ogni volta realizzare piccole soluzioni web con simili requisiti ho creato una piattaforma per semplificarmi il lavoro</p>
<p>Per dare un occhiata di cosa sto parlando ecco la pagina del progetto su Google Code: <a href=\"http://code.google.com/p/love4web/\">Love4Web Project</a></p>", "Luke", "Stile Libero");

$db->store($news_1);
$db->store($news_2);
*/

$news = $db->collect("news", 0, 2);
$website->addTemplate("index.tpl");
$website->templateAssign("news", $news);
$website->run();

?>