<?php

/**
 * Principal class.
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

class love4web {

	private static $version = "0.1-pre";
    private $template;
    private $config;
    private $smarty;

	static function getVersion()
	{
		return self::$version;
	}

	/**
	 * The class costructor
	 */
    function love4web()
    {
        $this->smarty = new SmartyML($_SESSION['lang']);
        $this->smarty->force_compile = true;
    }

	/**
	 * Run the framework and display the template
	 * @param bool $debug
	 */
    function run($debug = false)
    {
        if($debug)
            $this->smarty->debugging = true;
        $this->smarty->display($this->template);
    }

	/**
	 * Associate a template to the current php page
	 * @param string $name filename of the template
	 */
    function addTemplate($name)
    {
        $this->template = $name;
    }

	/**
	 * Assign a variable to the smarty system
	 * @param string $key key of the array
	 * @param string $what value of the array
	 */
    function templateAssign($key, $what)
    {
        $this->smarty->assign($key, $what);
    }

}

?>