<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><lang>pagetitle</lang></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="js/lightWindow.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/lightWindow.css" />

</head>
<body>

<div id="header">
  <div id="header_inner"> 
    <h1><span>Framework.</span>Home</h1>
    <div id="slogan">Administrative page <a href="logout.php"><small>logout</small></a></div>
  </div>
</div>

<div id="main"> 
  <div id="lcol"> 
    <div id="menu">
	{include file="mainMenu.tpl"}
    </div>
    <div id="menu_end"></div>
    <div id="lcontent"> 
      <h3 class="first">Interesting.<span>Stuff</span></h3>
      <ul class="divided">
        <li class="first"><a href="#">Tincidunt aliquam</a></li>
        <li><a href="#">Cursus lorem nulla</a></li>
        <li><a href="#">Nunc ante elit</a></li>
        <li><a href="#">Tincidunt aliquam</a></li>
        <li><a href="#">Cursus sed tempus</a></li>
      </ul>
      <h3>Aliquam.<span>Cursus</span></h3>
      <p><a href="#">Sollicitudin sed</a> arcu et vivamus viverra. Nullam turpis.
        Vestibulum Nullam turpis vestibulum.</p>
      <div class="divider"></div>
      <p><a href="#">Vestibulum veroeros</a> sed arcu et vivamus viverra lorem
        ipsum dolor sit amet dolore nulla facilisi.</p>
    </div>
  </div>

  <div id="rcol">
    <div id="rcontent">
      <h1>Admin<span>.page</span></h1>
      <span id="slogan2">Add, edit or delete anything.</span>
      
      <p>
		<ul>
			<li><a href="#">Manage news</a></li>
			<li><a href="#">Manage users</a></li>
			<li><a href="#">Manage privileges</a></li>
			<li><a href="#">Manage access</a></li>
		</ul>
      </p>
      

    </div>
  </div>
</div>

<div id="footer">
	&copy; 2007 Luca.Simone. All rights reserved.<br />
</div>

</body>
</html>