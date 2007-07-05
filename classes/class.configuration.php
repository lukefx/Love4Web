<?php

/**
 * Configuration class.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @link http://www.lukefx.com
 * @version 1.0
 * @author Luca Simone <simone.luca@gmail.com>
 * @access public
 * @package love4web
 */

/**
 * @package Smarty
 */

class Configuration
{
    private $configFile;
    private $items = array();

    static private $instance = NULL;

	/**
	 * This class use a singleton pattern, this method return an instance.
	 * @param string $configfile The path of the XML config file
	 * @return Configuration Configuration object
	 */
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