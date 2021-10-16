<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang = "en" lang="en" >
<?php require_once 'searchEngine.php'; ?>
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
			<input type="text" name="searchBar" placeholder="Search..." size='27'>
			<br>
			<h4>Your Location:</h4>
			<label>Chenango St, Morrisville, NY 13408</label>
			<br>
			<h4>Filter by Search Radius:</h4>
			<input type="radio" name="radius[]" value="1"  checked  <?php if(!empty($_POST['radius']) && in_array("1", $_POST['radius'])) echo 'checked="checked"';  ?>> Within 1 Mile   <br>
			<input type="radio" name="radius[]" value="10" 		    <?php if(!empty($_POST['radius']) && in_array("10", $_POST['radius'])) echo 'checked="checked"'; ?>> Within 10 Miles <br>
			<input type="radio" name="radius[]" value="20" 		    <?php if(!empty($_POST['radius']) && in_array("20", $_POST['radius'])) echo 'checked="checked"'; ?>> Within 20 Miles <br>
			<input type="radio" name="radius[]" value="30" 	        <?php if(!empty($_POST['radius']) && in_array("30", $_POST['radius'])) echo 'checked="checked"'; ?>> Within 30 Miles <br>
			<input type="radio" name="radius[]" value="40" 		    <?php if(!empty($_POST['radius']) && in_array("40", $_POST['radius'])) echo 'checked="checked"'; ?>> Within 40 Miles <br>
			<h4>Filter by Category:</h4>
			<input type="checkbox" name="category[]" value="Bar & Grill"  <?php if(!empty($_POST['category']) && in_array("Bar & Grill", $_POST['category'])) echo 'checked="checked"'; ?> > Bar & Grill <br>
			<input type="checkbox" name="category[]" value="Chinese"	  <?php if(!empty($_POST['category']) && in_array("Chinese", $_POST['category']))  	  echo 'checked="checked"'; ?> > Chinese     <br>
			<input type="checkbox" name="category[]" value="Desserts" 	  <?php if(!empty($_POST['category']) && in_array("Desserts", $_POST['category'])) 	  echo 'checked="checked"'; ?> > Dessert     <br>
			<input type="checkbox" name="category[]" value="Diner" 		  <?php if(!empty($_POST['category']) && in_array("Diner", $_POST['category']))  	  echo 'checked="checked"'; ?> > Diner       <br>
			<input type="checkbox" name="category[]" value="Indian"	      <?php if(!empty($_POST['category']) && in_array("Indian", $_POST['category']))  	  echo 'checked="checked"'; ?> > Indian      <br>
			<input type="checkbox" name="category[]" value="Italian" 	  <?php if(!empty($_POST['category']) && in_array("Italian", $_POST['category'])) 	  echo 'checked="checked"'; ?> > Italian     <br>
			<input type="checkbox" name="category[]" value="Mexican" 	  <?php if(!empty($_POST['category']) && in_array("Mexican", $_POST['category'])) 	  echo 'checked="checked"'; ?> > Mexican     <br>
			<input type="checkbox" name="category[]" value="Seafood" 	  <?php if(!empty($_POST['category']) && in_array("Seafood", $_POST['category'])) 	  echo 'checked="checked"'; ?> > Seafood     <br>
			<h4>Filter by Price Range:</h4>
			Min $<input type="text" name="min" size="3" />
			Max $<input type="text" name="max" size="3" />
			<h4>Filter by Star Rating:</h4>
			<input type="checkbox" name="rating[]" value="1"  <?php if(!empty($_POST['rating']) && in_array("1", $_POST['rating'])) echo 'checked="checked"'; ?> > 1 & Up <br>
			<input type="checkbox" name="rating[]" value="2"  <?php if(!empty($_POST['rating']) && in_array("2", $_POST['rating'])) echo 'checked="checked"'; ?> > 2 & Up <br>
			<input type="checkbox" name="rating[]" value="3"  <?php if(!empty($_POST['rating']) && in_array("3", $_POST['rating'])) echo 'checked="checked"'; ?> > 3 & Up <br>
			<input type="checkbox" name="rating[]" value="4"  <?php if(!empty($_POST['rating']) && in_array("4", $_POST['rating'])) echo 'checked="checked"'; ?> > 4 & Up <br>
			<br>
			<button class ="form-style-1" type="input" name="submit"> Submit </button>
			<?php $results = getSearchResults(); ?>
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