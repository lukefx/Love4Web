<?php

class Persistent {

    var $connessione;
    var $host = "localhost";
    var $db = "lukefx";
    var $db_user = "root";
    var $db_pass = "";

    private $firstResult;
    private $lastResult;

    static private $instance = NULL;

    static function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new Persistent();
        }
        return self::$instance;
    }

    function list()
    {
        return null;
    }

    function setFirstResult($firstResult)
    {
        $this->firstResult = $firstResult;
    }

    function setLastResult($lastResult)
    {
        $this->lastResult = $lastResult;
    }

    function store($object)
    {
        $classe = get_class($object);
        $variabili = get_object_vars($object);
        $objHash = md5(serialize($object));

        $this->connect();
        // check che la tabella col nome della classe esista nel db
        if(!$this->tableExists($classe, $this->db))
        {
            // se non esiste la creo
            $this->createTable($classe, $variabili);
        }

        // controllo che l'oggetto non esista gia' nel DB
        if($this->rowExist($classe, $objHash))
        {
            // esiste, UPDATE
            echo "esiste, posso fare update!<br />";
        }
        else
        {
            // non esiste, inserisco i dati
            echo "non esiste!<br />";
            $this->insertData($classe, $object);
        }
        $this->disconnect();
    }

    function restore(&$object, $id="a")
    {
        $class = get_class($object);
        $this->connect();

        if($id == "a")
        {
            $id = mysql_result(mysql_query("SELECT MAX(id) FROM `$class`"), 0);
        }

        $risultato = mysql_query("SELECT * FROM `$class` WHERE id=$id") or die("Query non valida: " . mysql_error());
        $args = mysql_fetch_assoc($risultato);
        $this->disconnect();
        $reflectionObj = new ReflectionClass($class);
        // Rimuovo l'id e l'hash key
        $object = $reflectionObj->newInstanceArgs(array_slice($args, 2, count($args)-1, true));
    }

    private function createTable($table, $variabili)
    {
        $query = "CREATE TABLE `$table` (`id` int(11) NOT NULL auto_increment, `md5` varchar(255) NOT NULL, ";
        foreach ($variabili as $nome => $valore) {
            $query .= "`$nome` varchar(255) NOT NULL default '', ";
        }
        $query .= "PRIMARY KEY  (`id`))";
        $risultato = mysql_query($query) or die("Query non valida: " . mysql_error());
    }

    private function rowExist($table, $hash)
    {
        $query = "SELECT id FROM `$table` WHERE md5='$hash'";
        $result = mysql_query($query);
        return mysql_num_rows($result);
    }

    private function insertData($table, &$object)
    {
        $variabili = get_object_vars($object);
        $fields = implode(array_keys($variabili), ',');
        $values = "'".implode(array_values($variabili), "','")."'";
        $query = 'INSERT INTO `'.$table.'` (md5,'.$fields.') VALUES (\''.md5(serialize($object)).'\','.$values.')';
        $res = mysql_query($query) or die(mysql_error());
    }

    private function tableExists($tablename, $db) {

        // Get a list of tables contained within the database.
        $result = mysql_list_tables($db);
        $rcount = mysql_num_rows($result);

        // Check each in list for a match.
        for ($i=0;$i<$rcount;$i++) {
            if (mysql_tablename($result, $i) == $tablename)
                return true;
        }
        return false;
    }

    private function connect()
    {
        $this->connessione = mysql_connect($this->host, $this->db_user, $this->db_pass) or die("Connessione non riuscita: " . mysql_error());
        mysql_select_db($this->db) or die("Selezione del database non riuscita");
    }

    private function disconnect()
    {
        mysql_close($this->connessione);
    }

}

?>