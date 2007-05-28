<?php

if ($dh = opendir("../classes")) {
   while (($file = readdir($dh)) !== false) {
      if (preg_match("/class\.([a-zA-Z0-9]+).php/", $file, $matches) > 0) {
          require_once("../classes/".$file);
      }
   }
}
else {
   die("Fatal Error: class folder not found.");
}

require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');

class PersistentTest extends UnitTestCase
{

    function setUp()
    {

    }

    function teardown()
    {
        $db = null;
    }

    function test_Store_objects_in_database()
    {

        // Clear the DB for this test
        $connessione = mysql_connect("localhost", "root", "") or die("Connessione non riuscita: " . mysql_error());
        mysql_select_db("lukefx") or die("Selezione del database non riuscita");
        $query = "DROP TABLE `news`";
        $risultato = mysql_query($query);
        mysql_close($connessione);

        /** Istanza di variabili */
        $db = Persistent::getInstance();

        $prova1 = new news("titolo", "testo", "autore", "categoria");
        $prova2 = new news("titolo", "testo", "autore", "categoria");
        $prova3 = new news("titoloz", "testoz", "autorez", "categoriaz");
        $prova4 = new news("titoloz", "testoz", "autorez", "categoriaz");
        $prova5 = new news();

        $prova6 = new news("titolozz", "testozz", "autorezz", "categoriazz");
        $prova7 = new news("titolozzz", "testozzz", "autorezzz", "categoriazzz");
        $prova8 = new news("titolozzzz", "testozzzz", "autorezzzz", "categoriazzzz");

        $this->assertTrue($db->store($prova1));
        $this->assertFalse($db->store($prova2));
        $this->assertTrue($db->store($prova3));
        $this->assertFalse($db->store($prova4));

        $db->store($prova6);
        $db->store($prova7);
        $db->store($prova8);
    }

    function test_Restore_objects_from_database()
    {
        $db = Persistent::getInstance();

        $prova5 = new news();
        $prova6 = new news("titoloz", "testoz", "autorez", "categoriaz");

        $db->restore($prova5, 2);
        $this->assertIsA($prova5, "news");
        $this->assertIdentical($prova5, $prova6);

    }

    function test_Collect_objects_from_database()
    {
        $db = Persistent::getInstance();

        $db->setFirstResult(1);
        $db->setLastResult(2);

        $this->assertEqual($db->getFirstResult(), 1);
        $this->assertEqual($db->getlastResult(), 2);

        $array_obj = $db->collect("news");
        $this->dump($array_obj);

    }

}

$test = &new PersistentTest();
$test->run(new HtmlReporter());

?>