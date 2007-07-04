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

</head>
<body>

<h1>Login <span>form</span></h1>
<img id="loadingIcon" style="display: none;" src="images/spinner.gif" /> <span id="ajax_msg">Login with your Google account.</span>

<div id="login" class="content">

    <form id="loginform" method="post" action="login.php">
        <label for="Email">Your username</label>
        <br />
        <input name="Email" id="Email" class="required validate-email" value="" size="30" type="text">
        <br />
        <label for="Passwd">Password</label>
        <br />
        <input name="Passwd" id="Passwd" class="required validate-alphanum" value="" size="30" type="password">
        <br /><br />
        <input name="sent" value="Login" type="submit">
    </form>

<script type="text/javascript">

</script>


</div>

</body>
</html>