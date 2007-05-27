<?php

session_start();

include_once("libs/SmartyML.class.php");

if ($dh = opendir("classes")) {
   while (($file = readdir($dh)) !== false) {
      if (preg_match("/class\.([a-zA-Z0-9]+).php/", $file, $matches) > 0) {
          require_once("classes/".$file);
      }
   }
}
else {
   die("Fatal Error: class folder not found.");
}

/* Definizione delle variabili d'ambiente */

// funzione di debugging
function print_array($array) {
	echo "<PRE>";
	print_r($array);
	echo "</PRE>";
}

?>
