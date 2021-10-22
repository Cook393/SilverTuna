<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<head>
	<link rel="stylesheet" type="text/css" href="elimination.css">
	<link rel="shortcut icon" href="logo2.jpg">
	<title>Silver Tuna</title>
	<meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="elimination.js"></script>
    <?php
		session_start();
		require_once "databasecontroller.php";	
		require_once "eliminationcontroller.php";
		$results = getSessionResults(); ?>
</head>
<header>
	<nav>
		<ul>
			<li><a class="active" href="home.php">Home</a></li>
			<li><a href="contact.html">Contact</a></li>
			<li><a href="about.html">About Us</a></li>
		</ul>
	</nav>
		<p>"That's the one, Marv. That's the <b>silver tuna</b>." <br> <i>Home Alone</i>, 1990  </p>
</header>
<body>
	<div class="wrapper">
		<div class="left">
			<ul id="results" class="sortable"><?php echoListItem($results);?></ul>
		</div>
		<div class="right">
			<ul id="trash" class="sortable"></ul>
		</div>
		<div style="clear: right"> </div>
		<div class="clear-div">
			<button id="clear" type="input"> Clear </button>
			<script> clearTrash();</script>
		</div>
	</div>
</body>
<footer>
	<small>Copyright &copy; 2021 Silver Tuna
		<br><a href="mailto:browne737@morrisville.edu">Email Us</a>
	</small>
</footer>
</html>