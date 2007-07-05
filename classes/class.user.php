<?php

class User
{
    var $username;
    var $password;
    var $level;         // Administrator o so on...

    function User($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->level = "Administrator";
    }
    
    public function getUsername()
    {	
    	return $this->username;
    }
    
    public function getPassword()
    {
    	return $this->password;
    }

}

?>