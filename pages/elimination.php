<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<head>
	<link rel="stylesheet" type="text/css" href="../css/elimination.css">
	<link rel="shortcut icon" href="../images/logo2.jpg">
	<title>Silver Tuna</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=2.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
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
	<div class="motto">
		<p>"That's the one, Marv. That's the <b>silver tuna</b>." <br> <i>Home Alone</i>, 1990  </p>
	</div>
</header>
<main id="main">
	<div class="overlay">
    	<button id="submitButton">Start</button>
	</div>
	<script src="../js/elimination.js"></script>
</main>
<footer>
	<small>Copyright &copy; 2021 Silver Tuna
		<br><a href="mailto:browne737@morrisville.edu">Email Us</a>
	</small>
</footer>
</html>