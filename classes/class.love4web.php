<?php

class love4web {

    private $template;
    private $config;
    private $smarty;

    function love4web()
    {
        $this->smarty = new SmartyML($_SESSION['lang']);
        $this->smarty->force_compile = true;
    }

    function run($debug = false)
    {
        if($debug)
            $this->smarty->debugging = true;
        $this->smarty->display($this->template);
    }

    function addTemplate($name)
    {
        $this->template = $name;
    }

    function templateAssign($key, $what)
    {
        $this->smarty->assign($key, $what);
    }

}

?>