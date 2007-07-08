<?php

class Session {

    var $id;
    var $log;
    var $dir;
    var $filename;
    var $login_page = "login.php";

    function Session($login_required = false)
    {
        // Inizializzo la sessione
        $this->load();

        // se la pagina richiede il login controllo...
        if ($login_required)
        {
            $this->requireLogin();
        }
        return true;
    }

    function expire()
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }

    function store($key, $var)
    {
        $_SESSION[$key] = $var;
        return true;
    }

    function restore($key)
    {
        return $_SESSION[$key];
    }

    function requireLogin()
    {
        if (!$this->isLoggedIn())
        {
            $_SESSION['page_destination'] = $_SERVER['SCRIPT_NAME'];
            header("Location: ".$this->login_page);
        }
    }

    function logged()
    {
        $_SESSION['logged_in'] = true;
        header("Location: ".$_SESSION['page_destination']);
    }

    function isLoggedIn()
    {
        return $_SESSION['logged_in'];
    }

    function sessionId()
    {
        return session_id();
    }

    function newId()
    {
        session_regenerate_id();
        return session_id();
    }

    private function load()
    {
        session_start();
    }

}

?>
