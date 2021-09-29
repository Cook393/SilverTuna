<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="tuna.css"></link>
		<link rel="shortcut icon" href="logo.jpg">
		<title>Silver Tuna</title>
		<meta charset="utf-8">		
    </head>
    <body>
    	<header>
	<form class = "form-style-1" action="search.php" method="get">
			<input type="text" name="searchBar" placeholder="Search.." size='50'>
			<input type ="submit" id="search">
		</form>
<nav><b><ul>
  <li><a href="home.html">Home</a></li>
  <li><a href="contact.html">Contact</a></li>
  <li><a href="about.html">About Us</a></li>
</ul></b></nav>
</header>
<main>	
		<!SEARCH BY RESTNAME/>
		<h1>Search Results:</h1>
		
		<?php	// Receives user input and queries restaurants by 'RestName'
		
				// Ensure database.php file is required
				require 'database.php';
				
				// Checking if searchBar exists
				if(isset($_GET["searchBar"])){
					
					// Getting and storing value from search bar
					$userInput = $_GET["searchBar"];
				
					// Input Validation: if the search bar is not empty, and the value is not 100% numeric
					if($userInput!= "" && !is_numeric($userInput)){ 
				
						// Execute user input RestName query
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE RestName LIKE' . "'%" . $userInput . "%'");
					}
				}
		?>
		
		<!SEARCH BY ZIPCODE/>
		
		<?php	// Receives user input and queries restaurants by 'ZipCode'
		
				// Checking if searchBar exists
				if(isset($_GET["searchBar"])){
				
					// Getting and storing value from search bar
					$userInput = $_GET["searchBar"];
				
					// Input Validation: if search bar is not empty, and the input is 100% numeric, and the input has 5 numbers: execute query
					if($userInput!= "" && is_numeric($userInput) && strlen($userInput) == 5){
					
						// Execute user input ZipCode query
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE ZipCode LIKE' . "'" . $userInput . "'");
				}
			}
		?>

		<!SEARCH BY CATEGORY/>
		
		<?php	// Receives user input and queries restaurants by 'CategoryID'
		
				
				// Checking if searchBar exists
				if(isset($_GET["searchBar"])){
				
					// Getting and storing value from search bar
					$userInput = $_GET["searchBar"];
				
					// Input Validation: if search bar is not empty, and the input is 100% numeric, and the input has 5 numbers: execute query
					switch(strtolower($userInput)){
					
						case "seafood":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 1');
						break;
					
						case "indian":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 2');
						break;
					
						case "desserts":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 3');
						break;
					
						case "diner":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 4');
						break;
					
						case "chinese":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 5');
						break;
					
						case "bar":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 6');
						break;
					
						case "mexican":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 7');
						break;
					
						case "italian":
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE CategoryID LIKE 8');
						break;
					}
				}
		?>
		
		<!SEARCH BY Rating/>
		
		<?php	// Recives user input and queries restaurants by 'Rating'
		
				// Checking if searchBar exists
				if(isset($_GET["searchBar"])){
				
					// Getting and storing value from search bar
					$userInput = $_GET["searchBar"];
				
					// Input Validation: if search bar is not empty, and the input is 100% numeric, and the input has 1 number: execute query
					if($userInput!= "" && is_numeric($userInput) && strlen($userInput) == 1){
					
						// Execute user input Rating query
						$results = executeRestaurantQuery('SELECT * FROM restaurant WHERE Rating LIKE' . "'" . $userInput . "'");
				}
			}
		?>
		
	</main>
    </body>
    <footer>
	<small><i>Copyright &copy; 2021 Silver Tuna
		<br><a href="mailto:browne737@morrisville.edu">Email Us</a>
	</i></small>
</footer>
</html>