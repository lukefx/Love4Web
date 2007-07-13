<?php

class Updater {
	
	private $remote_version;
	private $local_version;
	private $update_url = "https://localhost/love4web/update";	
	
	
	public function Updater()
	{
		$this->remote_version = $this->checkVersion();
		$this->local_version = love4web::getVersion();
		
	}
	
	function checkUpdate()
	{
		if(version_compare($this->remote_version, $this->local_version) > 0)
		{
			// Ci sono updates
			return $this->remote_version;
		}
		// Zebra...niente updates
		return false;
	}
	
	private function checkVersion()
	{
		$client = new IXR_Client('https://www.lukefx.com/xmlrpc.php');
		if (!$client->query('framework.version', 'php')) {
		    throw new Exception('Something went wrong - '.$client->getErrorCode().' : '.$client->getErrorMessage());
		}
		return $client->getResponse();
	}
	
	private function extractFramework()
	{
		$zip = new ZipArchive;
		if ($zip->open('test.zip') === TRUE) {
		    $zip->extractTo('/my/destination/dir/');
		    $zip->close();
		    return true;
		}
		else 
		{
		    throw new Exception("extract error");
		}
	}
	
	private function download($file_source, $file_target)
	{
	 	// Preparations
	  	$file_source = str_replace(' ', '%20', html_entity_decode($file_source)); // fix url format
	  	if (file_exists($file_target)) { chmod($file_target, 0777); } // add write permission
	
	  	// Begin transfer
	  	if (($rh = fopen($file_source, 'rb')) === FALSE) { return false; } // fopen() handles
	  	if (($wh = fopen($file_target, 'wb')) === FALSE) { return false; } // error messages.
	  	while (!feof($rh))
	  	{
	    	// unable to write to file, possibly because the harddrive has filled up
	    	if (fwrite($wh, fread($rh, 1024)) === FALSE) { fclose($rh); fclose($wh); return false; }
	  	}
	
	  	// Finished without errors
	  	fclose($rh);
	  	fclose($wh);
	  	return true;
	}
}

?>
