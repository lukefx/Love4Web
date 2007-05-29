<?php

require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');
require_once('ShowPasses.php');

$test = &new TestSuite('Love4Web Tests Suite');

if ($dh = opendir("."))
{
    while (($file = readdir($dh)) !== false)
    {
        if (preg_match("/test\.([a-zA-Z0-9]+).php/", $file, $matches) > 0)
        {
            $test->addTestFile($file);
        }
    }
}
else
{
    die("Fatal Error: Test folder not found.");
}

$test->run(new HtmlReporter());

?>