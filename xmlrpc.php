<?php

include("common.php");

class XmlrpcServer extends IXR_Server {

    function XmlrpcServer() {
        $this->IXR_Server(
            array(
            	'framework.version' => 'this:version'
            )
        );
    }
    
    function version($args)
	{
		$fw = new love4web();
		return $fw->getVersion();
	}

}

$config = Configuration::getInstance();

if(bool($config->xmlrpc))
    $server = new XmlrpcServer();

?>