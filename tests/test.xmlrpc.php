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

/**

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

class XmlrpcTest extends UnitTestCase
{

    function setup()
    {
        // setup var
    }

    function teardown()
    {
        // TearDown var
    }

    function test_xmlrpc_call()
    {
        // Create the client object
        $client = new IXR_Client('http://localhost/love4web/xmlrpc.php');
        $this->assertNotNull($client);
        
        $this->assertTrue($client->query('framework.version'));
        $this->assertIsA($client->getResponse(), "string");

    }

}

?>