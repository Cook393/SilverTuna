<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<?php
	session_start();
	require_once '../controllers/homecontroller.php';
	$results = searchResults();
	$_SESSION["query"] = $query;
?>
<head>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="shortcut icon" href="../images/logo2.jpg">
	<title>Silver Tuna</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
</head>
<header>
	<nav><ul>
		<li><a class="active" href="../pages/home.php">Home</a></li>
		<li><a href="../pages/contact.html">Contact</a></li>
		<li><a href="../pages/about.html">About Us</a></li>
		</ul>
	</nav>
		<p>"That's the one, Marv. That's the <b>silver tuna</b>." <br> <i>Home Alone</i>, 1990  </p>
</header>
<main>
<div class = "wrapper">
	<div class = "left">
		<form class="form-style-1" style ="" action="../pages/home.php" method="POST">
			<h5>Search by Restaurant Name:</h5>
			<input type="text" name="searchBar" placeholder ="Restaurant Name" value ="<?php echo $restName; ?>" >
			<h5>Your Location:</h5>
			<label>Chenango St, Morrisville, NY 13408</label>
			<h5>Filter by Search Radius:</h5>
			<input type="range" name="radius" min="1" max="120" value="<?php echo $radius; ?>" oninput="this.form.inputRadius.value=this.value" /><br>
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" name="inputRadius" min="1" max="120" value="<?php echo $radius; ?>" oninput="this.form.radius.value=this.value" /> Miles
			<h5>Filter by Category:</h5>
			<input type="checkbox" name="category[]" value="Bar & Grill"  <?php checkInput("category", "Bar & Grill"); ?> > Bar & Grill <br>
			<input type="checkbox" name="category[]" value="Chinese"	  <?php checkInput("category", "Chinese");     ?> > Chinese     <br>
			<input type="checkbox" name="category[]" value="Desserts" 	  <?php checkInput("category", "Desserts");    ?> > Dessert     <br>
			<input type="checkbox" name="category[]" value="Diner" 		  <?php checkInput("category", "Diner");  	   ?> > Diner       <br>
			<input type="checkbox" name="category[]" value="Indian"	      <?php checkInput("category", "Indian");  	   ?> > Indian      <br>
			<input type="checkbox" name="category[]" value="Italian" 	  <?php checkInput("category", "Italian"); 	   ?> > Italian     <br>
			<input type="checkbox" name="category[]" value="Mexican" 	  <?php checkInput("category", "Mexican"); 	   ?> > Mexican     <br>
			<input type="checkbox" name="category[]" value="Seafood" 	  <?php checkInput("category", "Seafood"); 	   ?> > Seafood     <br>
			<h5>Filter by Price Range:</h5>
			$<input type="number" name="min" size="3" min="0" max="999" placeholder = "Min" value = "<?php echo $min; ?>" /> -
			$<input type="number" name="max" size="3" min="0" max="999" placeholder = "Max" value = "<?php echo $max; ?>" />
			<h5>Filter by Star Rating:</h5>
			<input type="radio" name="rating[]" value="1" checked <?php checkInput("rating", "1"); ?> > 1 & Up <br>
			<input type="radio" name="rating[]" value="2"  		  <?php checkInput("rating", "2"); ?> > 2 & Up <br>
			<input type="radio" name="rating[]" value="3"  		  <?php checkInput("rating", "3"); ?> > 3 & Up <br>
			<input type="radio" name="rating[]" value="4"  	  	  <?php checkInput("rating", "4"); ?> > 4 & Up <br>
			<br>
			<button class ="submit" type="input" name="submit"> Submit </button>
		</form>
	</div>
	<div class="right">
		<form action="../pages/home.php" method="POST"> <?php displayResults($results); ?> </form>
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