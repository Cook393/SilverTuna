<?php
require_once 'databasecontroller.php';

//USER INPUT DATA

// location data (Charelton Hall)
$longitude = -75.64124222090817;
$latitude = 42.89651475818489;

// query data
$radius = 1;
$restName = "";
$category = "";
$rating = "";
$min ="";
$max ="";
$query = "";
$results = array();
$numberOfResults = 0;



//BASE QUERY BUILDER

// accepts 3 parameters(Longitude, Latitude, searchRadius) & returns a string query on the 'location' table for restaurants within the defined search radius
function getQuery($longitude, $latitude, $radius){
				
	$query = 	"SELECT
				rest.RestID, rest.RestName, rest.CategoryID, rest.LocID, rest.PricePoint, rest.Rating, rest.PhoneNumber, rest.URL,
				loc.ZipCode, loc.Address, loc.City, loc.State, loc.Latitude, loc.Longitude,
				cat.Category
				FROM location loc
				LEFT JOIN restaurant rest ON loc.LocID = rest.LocID
				RIGHT JOIN category cat ON rest.CategoryID = cat.CategoryID
				WHERE(ST_Distance_Sphere
				(point(loc.Longitude, loc.Latitude),
				point(" . "'" . $longitude . "', '" . $latitude . "'))
				* .000621371192) <= " . $radius;
												 
	return $query;
}			



//APPEND QUERY BUILDERS

// AND LIKE %$restName%
function andRestName($restName){
	
	$query = " AND rest.RestName LIKE" . "'%" . $restName . "%'";
	return $query;
}

// AND $category
function andCategory($category){

	$query = " AND (cat.Category= " . "'" . $category . "'";
	return $query;
}

// OR $category
function orCategory($category){
	
	$query = " OR cat.Category= " . "'" . $category . "'";
	return $query;
}

// AND BETWEEN $min AND $max pricepoint
function betweenPricePoints($min, $max){

	$query = " AND rest.PricePoint BETWEEN " . $min . " AND " . $max;
	return $query;
}

// AND greater than or equal to $rating
function andRating($rating){
	
	$query = " AND rest.Rating >= " . "'" . $rating . "'";
	return $query;
}

// ORDER BY $columnName ASC
function orderBy($columnName){
	
	$query = " ORDER BY " . $columnName . " ASC";
	return $query;
}



//APPEND QUERY BY USER INPUT

// append query based on radius user entered
function radiusAppend(){
	
	global $query;
	global $radius;
	global $longitude;
	global $latitude;
	
	// checking to see if Radius has a value
	if(!empty($_POST['radius'])) { 
					
		$radius = $_POST['radius'];
						
		$tempQuery = getQuery($longitude, $latitude, $radius);
		$query = $tempQuery;
	}
}

// append query based on restName user entered
function restNameAppend(){
	
	global $query;
	global $restName;
	
	// checking to see if searchBar has a value
	if(!empty($_POST['searchBar'])) { 
			
		$restName = $_POST['searchBar'];
		$query = $query . andRestName($restName);
	}
}

// append query based on categorys user entered
function categoryAppend(){
	
	global $query;
	global $category;
	
	// checking to see if Category has a value
	if(!empty($_POST['category'])) { 				
					
		$category = $_POST['category'];
		$length = count($category);
		$i = 0;
					
		foreach($category as $value){

			if($i == 0){ $query = $query . andCategory($value); }
			else if($i > 0 && $i < $length) { $query = $query . orCategory($value); }
			$i++;
		}
			
		$query = $query . ") ";
	}
}

// append query based on price range user entered
function pricePointAppend(){
	
	global $query;
	global $min;
	global $max;
	
	if(is_numeric($_POST['min']) && is_numeric($_POST['max'])){
			
		$min = $_POST['min'];
		$max = $_POST['max'];
				
		$query = $query . betweenPricePoints($min, $max);
	}
}

// append query based on rating user entered
function ratingAppend(){
	
	global $query;
	global $rating;
	
	// checking to see if Rating has a value
	if(!empty($_POST['rating'])) {
			
		$i = 1;
		$rating = $_POST['rating'];
			
		foreach($rating as $value){

			if($value != ""){ $query = $query . andRating($value); }
			$i++;
		}
	}
}

// append query to order the results
function orderingAppend(){
	
	global $query;
	
	// ordering query
	$query = $query . orderBy("RestName");
}



//SEARCH FUNCTIONS

// performs a search on the database based on the user's input, returns search result array
function searchResults(){
	
	global $query;
	global $results;

	// checking to see if certain controls exist, if they do create and append query based on user selection
	if(isset($_POST['submit'])){
			
		radiusAppend();
		restNameAppend();
		categoryAppend();	
		pricePointAppend();
		ratingAppend();

		// executing query and displaying results
		$results = executeQuery($query);
		
		return $results;
	}
}

function checkInput($name, $value){
	
	if(!empty($_POST[$name]) && in_array($value, $_POST[$name])) echo 'checked="checked"';
}



//DISPLAY FUNCTIONS

// test function for formatting user search results
function displayResults(){
	
	global $results;
	global $numberOfResults;
	
	if(isset($_POST['submit'])){
		
		// If there are results..
		if(mysqli_num_rows($results) > 0){
	
			$numberOfResults = mysqli_num_rows($results);
	
			// Fetch data (Loops through an array of results)
			while($row = mysqli_fetch_assoc($results)){
				
				// Format and display results
				echo(
					"<table border=\"1\" bgcolor=\"white\">
					<tr><td rowspan=\"3\"><img src=\"logo2.jpg\"></img></td>
					<td><h2>" . $row["RestName"] . "</h2></td>" .
					"<td><b> Rating:</b> " . $row["Rating"] . " Stars</td</tr>
					<tr>" .
					"<td><b> Category:</b> " . $row["Category"] . "</td>" .
					"<td><b> Average Dish Price:</b> " . $row["PricePoint"] . "</td></tr>
					<tr>" .
					"<td><b> Address:</b> " . $row["Address"] . ", " . $row["City"] . ", " . $row["State"] . " " . $row["ZipCode"] . "</td>" .
					"<td><a href=". $row["URL"] .">Website Link</a><br><b> Phone Number:</b> ". $row["PhoneNumber"] . "</td>
					</tr>
					</table>
					<br>"
				);
			}
			echo("<p> Number of Results: " . $numberOfResults ."</p>");

			echo(
				"<div class=\"eliminationDiv\">
				<a href=\"elimination.php\" target=\"_blank\">
				Want to narrow down your search results? 
				Try it out!
				</a>
				</div>"
			);
		}
		else{ echo "No results found..."; }
	}
}

function displayNumberOfResults(){

	global $numberOfResults;
	echo("<p> Number of Results: " . $numberOfResults ."</p>");
}
?>