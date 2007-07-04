<?php

class User
{

    private $username;
    private $password;
    private $level;         // Administrator o so on...

    function User($user)
    {
        $this->username = $user->username;
        $this->password = $user->password;

    }

}

?>