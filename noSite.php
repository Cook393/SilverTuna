<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<?php
	session_start();
	require_once 'homecontroller.php';
	$results = searchResults();
	$_SESSION["query"] = $query;
?>
<head>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="shortcut icon" href="logo2.jpg">
	<title>Silver Tuna</title>
	<meta charset="utf-8">
</head>
<header>
	<nav><ul>
		<li><a class="active" href="home.php">Home</a></li>
		<li><a href="contact.html">Contact</a></li>
		<li><a href="about.html">About Us</a></li>
		</ul>
	</nav>
		<p>"That's the one, Marv. That's the <b>silver tuna</b>." <br> <i>Home Alone</i>, 1990  </p>
</header>
<main>
<div class = "wrapper">
	<div class="noSite">
		This restaurant does not currently have a website.
		<p>Please <a href="mailto:browne737@morrisville.edu">EMAIL US</a> if you have any updates for this restaurant.
			<p>

			<button onclick="closeWin()">Click here to close this window</button>
  
    <script type="text/javascript">
        function closeWin() {
            window.close();
        }
    </script>
  
	</div>

</div>
<div style="clear: both"> </div>
</main>
<footer>
	<small>Copyright &copy; 2021 Silver Tuna
		<br><a href="mailto:browne737@morrisville.edu">Email Us</a>
	</small>
</footer>
</html>