<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="tuna.css"></link>
<link rel="shortcut icon" href="logo.jpg">
<title>Silver Tuna</title>
<meta charset="utf-8">
</head>

<?php

//CONNECTION DATA
$servername = "localhost";
$username = "root";
$password = "";
$database = "silvertuna";

//CONNECTION FUNCTIONS

// creates and returns a connection to phpMyAdmin
function createConnection(){ 
	
	global $servername;
	global $username;
	global $password;
	global $database;
	
	return $connection = mysqli_connect($servername, $username, $password, $database); 
}

// closes the current connection to phpMyAdmin
function closeConnection($connection){

	mysqli_close($connection);
} 

// test to see if a connection to phpMyAdmin exists, returns boolean
function testConnection($connection){
	
	if(!$connection){	
		
		// MySQL Connection Error Message
		die("Unable to connect: " . mysql_connect_error() . "<br>");
		
		return false;
	}
	else{	

		// Successful MySQL Connection Message	
		//echo("Connection successful! <br>");
		
		return true;
	}
}


//EXECUTE QUERY

// accepts parameter(query) and returns results
function executeQuery($query){ 
	
	// Creating & storing a database connection
	$connection = createConnection();
	
	// Checks to see if a connection exists
	if(testConnection($connection)){
		
		// Run MySQL query and store the results as an array of records
		$results = mysqli_query($connection, $query);
		
		// Closes current database connection
		closeConnection($connection);
		
		return $results;
	}
	else
	{ 	
		echo ("No results found <br>"); 
	}
}


//QUERY BUILDER FUNCTIONS

// accepts 3 parameters(Longitude, Latitude, searchRadius) & returns a string query on the 'location' table for restaurants within the defined search radius
function searchRadiusQuery($longitude, $latitude, $radius){ 
				
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


//QUERY APPEND FUNCTIONS

// where coniditon in RestName query
function andRestName($restName){
	
	$query = " AND rest.RestName LIKE" . "'%" . $restName . "%'";
	return $query;
}

// where condition in Category query
function andCategory($category){
	
	$query = " AND (cat.Category= " . "'" . $category . "'";
	return $query;
}

// where condition in Category query with OR
function orCategory($category){
	
	$query = " OR cat.Category= " . "'" . $category . "'";
	return $query;
}

// where condition in PricePoint query
function andPricePoint($num1, $num2){
	
	$query = " AND rest.PricePoint BETWEEN " . $num1 . " AND " . $num2;
	return $query;
}

// where condition in Rating query
function andRating($rating){
	
	$query = " AND rest.Rating >= " . "'" . $rating . "'";
	return $query;
}

// order by portion of query
function orderBy(){
	
	$query = " Order By RestName";
	return $query;
}


//DISPLAY FUNCTIONS

// test function for formatting user search results
function displayFormattedResults($results){
	
	// If there are results..
	if(mysqli_num_rows($results) > 0){
	
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
		}
	else{ 
	
		echo ("No results found.. <br>"); 
	}
}
?>

</html>