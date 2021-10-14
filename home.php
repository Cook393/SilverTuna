<!DOCTYPE html>
<html lang="en">
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
			<i>Search by Restaurant Name:</i>
			<input type="text" name="searchBar" placeholder="Search..." size='27'>
			<br>
			<br>
			<i>Your Location:</i>
			<input type="text" name="locationBar" placeholder="Chenango St, Morrisville, NY 13408" size='27'>
			<br>
			<br>
			<i>Filter by Search Radius:</i><br>
			<input type="radio" name="radius" value="1" checked>Within 1 Mile<br>
			<input type="radio" name="radius" value="10">Within 10 Miles<br>
			<input type="radio" name="radius" value="20">Within 20 Miles<br>
			<input type="radio" name="radius" value="30">Within 30 Miles<br>
			<input type="radio" name="radius" value="40">Within 40 Miles<br>
			<br>
			<i>Filter by Category:</i><br>
			<input type="checkbox" name="category[]" value="Bar & Grill">Bar & Grill<br>
			<input type="checkbox" name="category[]" value="Chinese">Chinese<br>
			<input type="checkbox" name="category[]" value="Desserts">Dessert<br>
			<input type="checkbox" name="category[]" value="Diner">Diner<br>
			<input type="checkbox" name="category[]" value="Indian">Indian<br>
			<input type="checkbox" name="category[]" value="Italian">Italian<br>
			<input type="checkbox" name="category[]" value="Mexican">Mexican<br>
			<input type="checkbox" name="category[]" value="Seafood">Seafood<br>
			<br>
			<i>Filter by Price Point:</i><br>
			<input type="radio" name="pricePoint" value="0,50" checked>$0-$50<br>
			<input type="radio" name="pricePoint" value="5,10">$5-$10<br>
			<input type="radio" name="pricePoint" value="10,15">$10-$15<br>
			<input type="radio" name="pricePoint" value="15,20">$15-$20<br>
			<input type="radio" name="pricePoint" value="25,30">$25-$30<br>
			<input type="radio" name="pricePoint" value="30,35">$30-$35<br>
			<input type="radio" name="pricePoint" value="35,40">$35-$40<br>
			<br>
			<i>Filter by Star Rating:</i><br>
			<input type="radio" name="rating" value="1" checked>1 Star & Up<br>
			<input type="radio" name="rating" value="2">2 Star & Up<br>
			<input type="radio" name="rating" value="3">3 Star & Up<br>
			<input type="radio" name="rating" value="4">4 Star & Up<br>
			<input type="radio" name="rating" value="5">5 Stars<br>
			<br>
			<button class ="form-style-1" type="input" name="submit"> Submit </button>	
		</form>
	</div>
	<div style="clear: right"> </div>
	<div class="resultsDiv">
		<form action="home.php" method="POST">
		
		<?php
			require_once 'databasecontroller.php';
			
			//Location Data (Charelton Hall)
			$longitude = -75.64124222090817;
			$latitude = 42.89651475818489;
			
			//User Input Data
			$radius = 0;
			$restName = "";
			$category = "";
			$pricePoint = "";
			$rating = 6;
			
			//Result Query
			$resultQuery = "";

			// checking to see if certain controls exist, if they do create and append query based on user selection
			if(isset($_POST['submit'])){
				
				// checking to see if Radius has a value
				if(!empty($_POST['radius'])) { 
					
					$radius = $_POST['radius'];
					$locationQuery = searchRadiusQuery($longitude, $latitude, $radius);
					$resultQuery = $locationQuery;
				}
				
				// checking to see if searchBar has a value
				if(!empty($_POST['searchBar'])) { 
					
					$restName = $_POST['searchBar'];
					$resultQuery = $resultQuery . andRestName($restName);
				}
				
				// checking to see if Category has a value
				if(!empty($_POST['category'])) { 				
					
					$cat = $_POST['category'];
					$length = count($cat);
					$i = 0;
					
					foreach($cat as $value){

						if($i == 0){ $resultQuery = $resultQuery . andCategory($value); }
						else if($i > 0 && $i < $length) { $resultQuery = $resultQuery . orCategory($value); }
						$i++;
					}
				    
					$resultQuery = $resultQuery . ") ";
				}
					
				// checking to see if PricePoint has a value
				if(!empty($_POST['pricePoint'])) {

					$pricePoint = $_POST['pricePoint'];
					$data = explode("," , $pricePoint);
					
					if(isset($data)){
						
						$num1 = $data[0];
						$num2 = $data[1];
						$resultQuery = $resultQuery . andPricePoint($num1, $num2);
					}
				}
				
				// checking to see if Rating has a value
				if(!empty($_POST['rating'])) {
					
					$rating = $_POST['rating'];
					$resultQuery = $resultQuery . andRating($rating);
				}
				
				$resultQuery = $resultQuery . orderBy();
				
				// storing result query and displaying the results
				$results = executeQuery($resultQuery);
				displayFormattedResults($results);
			}
		?>
		
		</form>
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