<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><lang>pagetitle</lang></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript" src="js/scriptaculous.js"></script>
<script type="text/javascript" src="js/modalbox.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/validation.css" />
<link rel="stylesheet" href="css/modalbox.css" type="text/css" media="screen" />

</head>
<body>

<div id="header">

  <div id="header_inner"> 
    <h1><span>Framework.</span>Home</h1>
    <div id="slogan"><lang>slogan</lang></div>
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
      <h1>New<span>.Website<sup>2.0</sup></span></h1>
      <span id="slogan2">design, style and technology</span>
      <div class="box">
        <div class="box_inner">
          <div class="captioned_image"> <img src="images/pic.jpg" alt="Figure 1" />
            <div>Fig 1. Obscure?</div>
          </div>
          <h2>Some obscure headline</h2>
          <p><lang>explaination</lang></p>
        </div>
      </div>
      <!-- dynamic content -->

      {foreach from=$news key=id item=news_data}
        <div class="news_{$id}">
          <h3 id="news_{$id}_title">{$news_data->title}</h3>
          <div id="news_{$id}_text">
          {$news_data->text}
          </div>
          <div class="divider"></div>
          <div class="summary">- {$news_data->author}</div>
        </div>
      {/foreach}

      <!-- end dynamic content -->
    </div>
  </div>
</div>

<div id="footer">
	&copy; 2007 Luca.Simone. All rights reserved.<br />
</div>

</body>
</html>