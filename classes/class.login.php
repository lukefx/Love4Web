<?php

    // Interfaccia principale che definisce i metodi di base
    interface Login
    {
        public function login();
        public function getUserInfo();
    }


    // implementazione concreta del login
    class GoogleLogin implements Login
    {

        private $user;
        private $authcode;

        function GoogleLogin($user)
        {
            $this->user = $user;
        }

        public function login()
        {
           	$buf = sprintf('accountType=GOOGLE&Email=%s&Passwd=%s&service=cl&source=%s',
         		rawurlencode($this->user->username),
          		rawurlencode($this->user->password),
          		rawurlencode('love4web-Lukefx-1.0'));

        	$ch = curl_init('https://www.google.com/accounts/ClientLogin');
        	curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $buf);
        	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        	$res = curl_exec($ch);
        	preg_match('/auth=(.+)/i',$res,$m);
        	$this->authcode = $m[1];
        }

        public function getUserInfo()
        {
            return $this->user->username;
        }

    }

?>