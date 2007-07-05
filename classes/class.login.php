<?php

	abstract class Login
	{
		protected $user;
		
		abstract function login();
		
		public function getUserInfo()
        {
            return $this->user->getUsername();
        }
	}

	class DBLogin extends Login
	{
		
		function DBLogin($user)
		{
			$this->user = $user;
		}
		
		function login()
		{
			$db = Persistent::getInstance();
			$where = sprintf("username='%s' and password='%s'", $this->user->getUsername(), md5($this->user->getPassword()));
			$news = $db->search("User", $where);
			
			if($news)
			{
				return true;
			}
			return false;
			
		}
		
	}

    // implementazione concreta del login
    class GoogleLogin extends Login
    {
        private $authcode;

        function GoogleLogin($user)
        {
            $this->user = $user;
        }

        function login()
        {
           	$buf = sprintf('accountType=GOOGLE&Email=%s&Passwd=%s&service=cl&source=%s',
         	rawurlencode($this->user->getUsername()),
          	rawurlencode($this->user->getPassword()),
          	rawurlencode('love4web-Lukefx-1.0'));

        	$ch = curl_init('https://www.google.com/accounts/ClientLogin');
        	curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $buf);
        	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        	$res = curl_exec($ch);
        	if(preg_match('/auth=(.+)/i',$res,$m))
        	{
        		$this->authcode = $m[1];
        		return true;     		
        	}
        	return false;

        }

    }

?>