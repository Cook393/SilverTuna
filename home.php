<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<?php require_once 'searchEngine.php'; ?>
<?php $results = searchResults(); ?>
    <head>
	<link rel="stylesheet" type="text/css" href="tuna.css">
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
<div class = "mainDiv">
	<div class = "searchDiv">
		<form class="form-style-1" style ="" action="home.php" method="POST">
			<h4>Search by Restaurant Name:</h4>
			<input type="text" name="searchBar" placeholder = "Restaurant Name" value = "<?php echo $restName; ?>" size='27'>
			<h4>Your Location:</h4>
			<label>Chenango St, Morrisville, NY 13408</label>
			<h4>Filter by Search Radius:</h4>
			<input type="radio" name="radius[]" value="1"  checked  <?php checkInput("radius", "1");  ?> > Within 1 Mile   <br>
			<input type="radio" name="radius[]" value="10" 		    <?php checkInput("radius", "10"); ?> > Within 10 Miles <br>
			<input type="radio" name="radius[]" value="20" 		    <?php checkInput("radius", "20"); ?> > Within 20 Miles <br>
			<input type="radio" name="radius[]" value="30" 	        <?php checkInput("radius", "30"); ?> > Within 30 Miles <br>
			<input type="radio" name="radius[]" value="40" 		    <?php checkInput("radius", "40"); ?> > Within 40 Miles <br>
			<h4>Filter by Category:</h4>
			<input type="checkbox" name="category[]" value="Bar & Grill"  <?php checkInput("category", "Bar & Grill"); ?> > Bar & Grill <br>
			<input type="checkbox" name="category[]" value="Chinese"	  <?php checkInput("category", "Chinese");     ?> > Chinese     <br>
			<input type="checkbox" name="category[]" value="Desserts" 	  <?php checkInput("category", "Desserts");    ?> > Dessert     <br>
			<input type="checkbox" name="category[]" value="Diner" 		  <?php checkInput("category", "Diner");  	   ?> > Diner       <br>
			<input type="checkbox" name="category[]" value="Indian"	      <?php checkInput("category", "Indian");  	   ?> > Indian      <br>
			<input type="checkbox" name="category[]" value="Italian" 	  <?php checkInput("category", "Italian"); 	   ?> > Italian     <br>
			<input type="checkbox" name="category[]" value="Mexican" 	  <?php checkInput("category", "Mexican"); 	   ?> > Mexican     <br>
			<input type="checkbox" name="category[]" value="Seafood" 	  <?php checkInput("category", "Seafood"); 	   ?> > Seafood     <br>
			<h4>Filter by Price Range:</h4>
			<input type="text" name="min" size="3" placeholder = "$ Min" value = "<?php echo $min; ?>" /> <b>-</b>
			<input type="text" name="max" size="3" placeholder = "$ Max" value = "<?php echo $max; ?>" />
			<h4>Filter by Star Rating:</h4>
			<input type="radio" name="rating[]" value="1"  <?php checkInput("rating", "1"); ?> > 1 & Up <br>
			<input type="radio" name="rating[]" value="2"  <?php checkInput("rating", "2"); ?> > 2 & Up <br>
			<input type="radio" name="rating[]" value="3"  <?php checkInput("rating", "3"); ?> > 3 & Up <br>
			<input type="radio" name="rating[]" value="4"  <?php checkInput("rating", "4"); ?> > 4 & Up <br>
			<br>
			<button class ="form-style-1" type="input" name="submit"> Submit </button>
		</form>
	</div>
	<div style="clear: right"> </div>
	<div class="resultsDiv">
		<form action="home.php" method="POST"> <?php displayResults($results); ?> </form>
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