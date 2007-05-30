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

/*

assertTrue($x)	                Fail if $x is false
assertFalse($x)	                Fail if $x is true
assertNull($x)	                Fail if $x is set
assertNotNull($x)	            Fail if $x not set
assertIsA($x, $t)	            Fail if $x is not the class or type $t
assertNotA($x, $t)	            Fail if $x is of the class or type $t
assertEqual($x, $y)	            Fail if $x == $y is false
assertNotEqual($x, $y)	        Fail if $x == $y is true
assertWithinMargin($x, $y, $m)	Fail if abs($x - $y) < $m is false
assertOutsideMargin($x, $y, $m)	Fail if abs($x - $y) < $m is true
assertIdentical($x, $y)	        Fail if $x == $y is false or a type mismatch
assertNotIdentical($x, $y)	    Fail if $x == $y is true and types match
assertReference($x, $y)	        Fail unless $x and $y are the same variable
assertClone($x, $y)	            Fail unless $x and $y are identical copies
assertPattern($p, $x)	        Fail unless the regex $p matches $x
assertNoPattern($p, $x)	        Fail if the regex $p matches $x
expectError($x)	                Swallows any upcoming matching error
assert($e)	                    Fail on failed expectation object $e

*/

class PersistentTest extends UnitTestCase
{

    function teardown()
    {
        $db = null;
    }

    function test_drop_DB()
    {
        // Clear the DB for this test
        $connessione = mysql_connect("localhost", "root", "") or die("Connessione non riuscita: " . mysql_error());
        $this->assertTrue(mysql_select_db("lukefx_test"));
        $query = "DROP TABLE `news`";
        $risultato = mysql_query($query);
        $this->assertTrue($risultato);
        mysql_close($connessione);
    }

    function test_Store_objects_in_database()
    {
        /** Istanza di variabili */
        $db = Persistent::getInstance();
        $db->setDB("lukefx_test");

        // Creo tutti gli oggetti che mi servono
        $prova1 = new news("titolo", "testo", "autore", "categoria");
        $prova2 = new news("titolazzo", "testo", "autore", "categoria");
        $prova3 = new news("titoloz", "testoz", "autorez", "categoriaz");
        $prova4 = new news("titoloz", "testoz", "autorez", "categoriaz");
        $prova5 = new news();
        $prova6 = new news("titolozz", "testozz", "autorezz", "categoriazz");
        $prova7 = new news("titolozzz", "testozzz", "autorezzz", "categoriazzz");
        $prova8 = new news("titolozzz", "testozzz", "autorezzz", "categoriazzz");

        // test insert
        $this->assertNotNull($id = $db->store($prova1));
        $this->assertIdentical($id, 1);

        // test update
        $this->assertNotNull($id = $db->store($prova2, $id));
        $this->assertIdentical($id, 1);

        // testo altri insert
        $this->assertNotNull($id3 = $db->store($prova3));
        $this->assertNotNull($id4 = $db->store($prova4));

        // l'oggetto 3 = 4 -> non deve inserirlo e ridarmi l'id 3
        $this->assertIdentical($id3, $id4);

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
        $this->assertNotNull($array_obj);

    }

}

?>