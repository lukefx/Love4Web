<?php

include("common.php");

class XmlrpcServer extends IXR_Server {

	private $methods = array();

    function XmlrpcServer() 
    {
        $this->IXR_Server(
            array(
            	'framework.version' => 'this:version'
            )
        );
    }
    
    function version($args)
	{
		return love4web::getVersion();
	}

}

$config = Configuration::getInstance();

if(bool($config->xmlrpc))
    $server = new XmlrpcServer();

?>