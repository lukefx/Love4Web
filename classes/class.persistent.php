<?php

class Persistent {

    private $connessione;
    private $host = "localhost";
    private $db = "lukefx";
    private $db_user = "root";
    private $db_pass = "";

    private $firstResult;
    private $lastResult;

    static function getInstance($config = null)
    {
        if(!$config)
            $config = new Configuration();
        return new Persistent($config->DbHost, $config->Database, $config->DbUsername, $config->DbPassword);
    }

    private function Persistent($host, $db, $db_user, $db_pass)
    {
        $this->host = $host;
        $this->db = $db;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    function setDB($string)
    {
        $this->db = $string;
    }

    function store($object, $id = 0)
    {
        $classe = get_class($object);
        $objHash = md5(serialize($object));

        $this->connect();
        // check che la tabella col nome della classe esista nel db
        if(!$this->tableExists($classe, $this->db))
        {
            // se non esiste la creo
            $this->createTable($classe, $object);
        }

        // controllo che l'oggetto non esista gia' nel DB
        if(($existent_id = $this->rowExist($classe, $objHash)) != 0)
        {
            // lo stesso oggetto identico esiste gia' nel database
            return (int)$existent_id;
        }
        else
        {
            if($id != 0)
            {
                // se viene passato un id eseguo l'update
                $this->updateData($classe, $object, $id);
            }
            else
            {
                // altrimenti lo inserisco
                $id = $this->insertData($classe, $object);
            }
        }
        $this->disconnect();
        return $id;
    }

    function restore(&$object, $id=0)
    {
        $class = get_class($object);
        $this->connect();

        if(!$id)
        {
            $id = mysql_result(mysql_query("SELECT MAX(id) FROM `$class`"), 0);
        }

        $risultato = mysql_query("SELECT * FROM `$class` WHERE id=$id") or die("[Restore] Query non valida: " . mysql_error());
        $args = mysql_fetch_assoc($risultato);
        $this->disconnect();
        $reflectionObj = new ReflectionClass($class);
        // Rimuovo l'id e l'hash key
        $object = $reflectionObj->newInstanceArgs(array_slice($args, 2, count($args)-1, true));
    }

    function collect($table, $firstResult = 0, $lastResult = 0)
    {
        $ret = array();
        $this->connect();

        if(!$firstResult || !$lastResult)
        {
            $this->firstResult = 0;
            $this->lastResult = 1;
        }

        $query = "SELECT * FROM `$table` LIMIT " . $this->firstResult . ", " . $this->lastResult;
        if(!($risultato = mysql_query($query)))
            throw new SQLException(mysql_error());

        while ($linea = mysql_fetch_array($risultato, MYSQL_ASSOC))
        {
            $reflectionObj = new ReflectionClass($table);
            // Rimuovo l'id e l'hash key
            $object = $reflectionObj->newInstanceArgs(array_slice($linea, 2, count($linea)-1, true));
            $ret[] = $object;
        }
        $this->disconnect();
        return $ret;
    }

    function search($table, $where)
    {
        $ret = array();
        $this->connect();
        $query = "SELECT * FROM `$table` WHERE $where";
        if(!($risultato = mysql_query($query)))
            throw new SQLException(mysql_error());

        while ($linea = mysql_fetch_array($risultato, MYSQL_ASSOC))
        {
            $reflectionObj = new ReflectionClass($table);
            // Rimuovo l'id e l'hash key
            $object = $reflectionObj->newInstanceArgs(array_slice($linea, 2, count($linea)-1, true));
            $ret[] = $object;
        }
        $this->disconnect();
        return $ret;
    }

    function setFirstResult($firstResult)
    {
        $this->firstResult = $firstResult;
    }

    function setLastResult($lastResult)
    {
        $this->lastResult = $lastResult;
    }

    function getFirstResult()
    {
        return $this->firstResult;
    }

    function getLastResult()
    {
        return $this->lastResult;
    }

    private function createTable($table, $object)
    {
        $variabili = get_object_vars($object);

        $query = "CREATE TABLE `$table` (`id` int(11) NOT NULL auto_increment, `md5` varchar(255) NOT NULL, ";
        foreach ($variabili as $nome => $valore)
        {
            if(strlen($valore) > 255)
                $query .= "`$nome` text NOT NULL default '', ";
            else
                $query .= "`$nome` varchar(255) NOT NULL default '', ";
        }
        $query .= "PRIMARY KEY (`id`))";
        if(!mysql_query($query))
            throw new SQLException(mysql_error());
    }

    private function rowExist($table, $hash)
    {
        $query = "SELECT id FROM `$table` WHERE md5='$hash'";
        $result = mysql_query($query);
        $riga = mysql_fetch_assoc($result);
        if($riga)
            return $riga['id'];
        else
            return 0;
    }

    private function insertData($table, &$object)
    {
        $variabili = get_object_vars($object);
        $fields = implode(array_keys($variabili), ',');
        $values = "'".implode(array_map('mysql_real_escape_string', (array_values($variabili))), "','")."'";
        $query = 'INSERT INTO `'.$table.'` (md5,'.$fields.') VALUES (\''.md5(serialize($object)).'\','.$values.')';
        if(!mysql_query($query))
            throw new SQLException(mysql_error());
        return mysql_insert_id();
    }

    private function updateData($table, &$object, $id)
    {
        $variabili = get_object_vars($object);
        $query = 'UPDATE `'.$table.'` SET md5=\''.md5(serialize($object)).'\'';
        foreach ($variabili as $nome => $valore) {
            $query .= ", $nome = '".mysql_real_escape_string($valore)."'";
        }
        $query .= " WHERE id=$id";

        if(!mysql_query($query))
            throw new SQLException(mysql_error());
        return mysql_insert_id();
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
        if(!mysql_select_db($this->db))
            throw new SQLException();
        return true;
    }

    private function disconnect()
    {
        if(!mysql_close($this->connessione))
            throw new SQLException();
        return true;
    }

}

?>