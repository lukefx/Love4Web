<?php

class Configuration
{
    private $configFile;
    private $items = array();

    static private $instance = NULL;

    static function getInstance($configFile = 'configs/config.xml')
    {
        if(self::$instance == NULL)
        {
            self::$instance = new Configuration($configFile);
        }
        return self::$instance;
    }

    private function Configuration($configFile)
    {
        $this->configFile = $configFile;
        $this->parse();
    }

    function __get($id)
    {
        return $this->items[$id];
    }

    function parse()
    {
        $doc = new DOMDocument();
        $doc->load($this->configFile);
        $cn = $doc->getElementsByTagName("config");

        $nodes = $cn->item(0)->getElementsByTagName("*");
        foreach($nodes as $node)
            $this->items[$node->nodeName] = $node->nodeValue;
    }

    function save()
    {
        $doc = new DOMDocument();
        $doc->formatOutput = true;

        $r = $doc->createElement("config");
        $doc->appendChild($r);

        foreach($this->items as $k => $v)
        {
            $kn = $doc->createElement($k);
            $kn->appendChild( $doc->createTextNode($v));
            $r->appendChild($kn);
        }
        copy($this->configFile, $this->configFile.'.bak');
        $doc->save($this->configFile);
    }

}
    // Out of class for easy call...easy and dirty
    function bool($var) {
        switch (strtolower($var)) {
            case ("true"):
                return true;
                break;
            case ("false"):
                return false;
                break;
        default:
                return false;
                break;
        }
    }

?>