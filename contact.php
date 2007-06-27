<?php

include("common.php");

if(isset($_POST) && !empty($_POST))
{
    // ajax request
    $mail = new PHPMailer();

    $mail->From     = $_POST['useraddr'];
    $mail->FromName = "List manager";
    $mail->Host     = "mail.lukefx.com";
    $mail->Mailer   = "smtp";

    $body  = $_POST['comments'];

    $mail->Body    = $body;
    $mail->AltBody = $text_body;
    $mail->AddAddress($row["email"], $row["full_name"]);

    if(!$mail->Send())
        echo "Some problem occours :-( sorry";
    else
        echo "Thank you :-)";

    exit();
}

$website = new love4web();
$website->addTemplate("contact.tpl");
$website->run();


?>