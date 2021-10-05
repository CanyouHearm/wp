<?php

if (isset($_GET['link_page'])) {
	$link_page = $_GET['link_page'];
} else {
	$link_page = "home";
}

$page_file = "pages/" . $link_page . ".php";

$safe_check1 = "strpos('$page_file', '..') === false";
assert($safe_check1) or die("no no no!");

// safe!
$safe_check2 = "file_exists('$page_file')";
assert($safe_check2) or die("no this file!");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>PHP Demo</title>
		
		<link rel="stylesheet" href="static/bootstrap.min.css" />
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
		    	<div class="navbar-header">
		    		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            	<span class="sr-only">切换导航</span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		          	</button>
		          	<a class="navbar-brand" href="#">Demo</a>
		        </div>
		        <div id="navbar" class="collapse navbar-collapse">
		          	<ul class="nav navbar-nav">
		            	<li <?php if ($link_page == "home") { ?>class="active"<?php } ?>><a href="?link_page=home">首页</a></li>
		            	<li <?php if ($link_page == "about") { ?>class="active"<?php } ?>><a href="?link_page=about">关于</a></li>
		            	<li <?php if ($link_page == "contact") { ?>class="active"<?php } ?>><a href="?link_page=contact">联系方式</a></li>
						<!--<li <?php if ($link_page == "flag") { ?>class="active"<?php } ?>><a href="?link_page=flag">My secrets</a></li> -->
		          	</ul>
		        </div>
		    </div>
		</nav>
		
		<div class="container" style="margin-top: 50px">
			<?php
				require_once $page_file;
			?>
			
		</div>
		
		<script src="static/jquery.min.js" />
		<script src="static/bootstrap.min.js" />
	</body>
</html>