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

// accepts parameter(RestName) and returns a query on the 'restaurant' table based on the RestName
function restNameQuery($restName){ 
	
	$query = 	"SELECT 
				rest.RestID, rest.RestName, rest.CategoryID, rest.LocID, rest.PricePoint, rest.Rating, rest.PhoneNumber, rest.URL,
				loc.ZipCode, loc.Address, loc.City, loc.State, loc.Latitude, loc.Longitude,
				cat.Category
				FROM restaurant rest
			    RIGHT JOIN location loc ON rest.LocID = loc.LocID
				RIGHT JOIN category cat ON rest.CategoryID = cat.CategoryID
				WHERE rest.RestName LIKE" . "'%" . $restName . "%'";
										
	return $query;
}									     

// accepts parameter(Price Point Range) and returns a query on the 'restaurant' table based on the PricePoint range
function pricePointQuery($num1, $num2){
	
	$query = 	"SELECT
				rest.RestID, rest.RestName, rest.CategoryID, rest.LocID, rest.PricePoint, rest.Rating, rest.PhoneNumber, rest.URL,
				loc.ZipCode, loc.Address, loc.City, loc.State, loc.Latitude, loc.Longitude,
				cat.Category
				FROM restaurant rest
			    RIGHT JOIN location loc ON rest.LocID = loc.LocID
				RIGHT JOIN category cat ON rest.CategoryID = cat.CategoryID
				WHERE rest.PricePoint BETWEEN " . $num1 . " AND " . $num2;
										
	return $query;
}

// accepts parameter(Category) and returns a query on the 'category' table based on the Category
function categoryQuery($category){ 

	$query = 	"SELECT
				rest.RestID, rest.RestName, rest.CategoryID, rest.LocID, rest.PricePoint, rest.Rating, rest.PhoneNumber, rest.URL,
				loc.ZipCode, loc.Address, loc.City, loc.State, loc.Latitude, loc.Longitude,
				cat.Category
				FROM category cat
				LEFT JOIN restaurant rest ON cat.CategoryID = rest.CategoryID
				RIGHT JOIN location loc ON rest.LocID = loc.LocID
				WHERE cat.Category= " . "'" . $category . "'";
												 
	return $query;
}

// accepts parameter(Rating) and returns a query on the 'restaurant' table based on the Rating
function ratingQuery($rating){  

	$query = 	"SELECT
				rest.RestID, rest.RestName, rest.CategoryID, rest.LocID, rest.PricePoint, rest.Rating, rest.PhoneNumber, rest.URL,
				loc.ZipCode, loc.Address, loc.City, loc.State, loc.Latitude, loc.Longitude,
				cat.Category
				FROM restaurant rest
			    RIGHT JOIN location loc ON rest.LocID = loc.LocID
				RIGHT JOIN category cat ON rest.CategoryID = cat.CategoryID
				WHERE rest.Rating >=" . $rating;
										
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
function orderByRestName(){
	
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
					"<h2>" . $row["RestName"] . "</h2>" .
					
					"Phone: " . $row["PhoneNumber"] . "<br>" .
					
					"Website: " . $row["URL"] . "<br>" .
					
					"Address: " . $row["Address"] . ",  " . $row["City"] . ",  " . $row["State"] . " " . $row["ZipCode"] . "<br>" .

					"Category: " . $row["Category"] . "<br>" . 
					
					"PricePoint: " . $row["PricePoint"] . "<br>" .

					"Rating: " . $row["Rating"] . "<br>"
				);
			}
		}
	else{ 
	
		echo ("No results found.. <br>"); 
	}
}

?>