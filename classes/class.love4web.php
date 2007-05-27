<?php

class love4web {

    var $template;

    function run()
    {
      $smarty = new SmartyML($_SESSION['lang']);
      $smarty->force_compile = true;
      //$smarty->debugging = true;
      $smarty->assign("notice", $_SESSION['notice']);
      $smarty->display($this->template);
    }

    function addTemplate($name)
    {
        $this->template = $name;
    }

}

?>