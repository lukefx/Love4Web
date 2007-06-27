<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><lang>pagetitle</lang></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js"></script>
<script type="text/javascript" src="js/validation.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="css/modalbox.css" type="text/css" media="screen" />

</head>
<body>

<h1>Contact <span>form</span></h1>
<img id="loadingIcon" style="display: none;" src="images/spinner.gif" /> <span id="ajax_msg">Leave me some feedback if you want</span>

<div id="contact" class="content">
    <form id="mailform">
        <label for="username">Your Name</label>
        <br>
        <input name="username" id="username" class="required validate-alphanum" value="" size="30" type="text"><br>
        <label for="useraddr">Your Email</label>
        <br>
        <input name="useraddr" id="useraddr" class="required validate-email" value="" size="30" type="text"><br>
        <label for="comments">Your Message</label><br>
        <textarea name="comments" cols="50" rows="12" id="comments"></textarea><br>
        <input name="sent" value="Send Message" type="button" onclick="
          {literal}
              var valid = new Validation('mailform');
              if(valid.validate())
              {
                $('loadingIcon').toggle();
                new Ajax.Request('contact.php', {
                    method: 'post',
                    parameters: $('mailform').serialize(),
                    onSuccess: function(transport) {
                        $('ajax_msg').innerHTML = transport.responseText;
                        $('loadingIcon').toggle();
                    }
                });
                $('contact').hide();
                Modalbox.resize(0, -350);
              }
          {/literal}
        ">
    </form>
</div>

</body>
</html>