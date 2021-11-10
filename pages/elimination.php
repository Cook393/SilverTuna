<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<head>
	<link rel="stylesheet" type="text/css" href="../css/elimination.css">
	<link rel="shortcut icon" href="../images/logo2.jpg">
	<title>Silver Tuna</title>
	<meta charset="utf-8">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
		session_start();
		require_once "../php/database.php";	
		require_once "../controllers/eliminationcontroller.php";
		$data = getSessionData();
		$encodedData = encodeData($data);
		file_put_contents('../json/results.json', $encodedData);
	?>
</head>
<header>
	<nav>
		<ul>
			<li><a class="active" href="../pages/home.php">Home</a></li>
			<li><a href="../pages/contact.html">Contact</a></li>
			<li><a href="../pages/about.html">About Us</a></li>
		</ul>
	</nav>
		<p>"That's the one, Marv. That's the <b>silver tuna</b>." <br> <i>Home Alone</i>, 1990</p>
</header>
<body>
	<br>
	<hr>
	<br>
	<div class="wrapper">
		<div class="left">
			<ul class="sortable" id="trash"></ul>
		</div>
		<div class="center">
			<ul class="sortable" id="results"></ul>
		</div>
		<div class="right" id="right">
			<ul class="sortable" id="keep"></ul>
		</div>
		<div style="clear: both"></div>
	</div>
	<br>
	<hr>
	<br>
	<script src="../js/elimination.js"></script>
</body>
<footer>
	<small>Copyright &copy; 2021 Silver Tuna
		<br><a href="mailto:browne737@morrisville.edu">Email Us</a>
	</small>
</footer>
</html>