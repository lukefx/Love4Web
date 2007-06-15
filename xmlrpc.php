<?php

include("common.php");

class XmlrpcServer extends IXR_Server {

    function XmlrpcServer() {
        $this->IXR_Server(
            array(
                'demo.sayHello' => 'this:sayHello',
                'demo.addTwoNumbers' => 'this:addTwoNumbers'
            )
        );
    }

    // test function
    function sayHello($args)
    {
        return 'Hello!';
    }

    function addTwoNumbers($args)
    {
        $number1 = $args[0];
        $number2 = $args[1];
        return $number1 + $number2;
    }
}

$server = new XmlrpcServer();

?>