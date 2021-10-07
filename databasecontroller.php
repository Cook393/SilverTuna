<?php


//CONNECTION DATA
$servername = "localhost";
$username = "root";
$password = "";
$database = "silvertuna";



//CONNECTION FUNCTIONS

function createConnection(){
	
	global $servername;
	global $username;
	global $password;
	global $database;
	
	return $connection = mysqli_connect($servername, $username, $password, $database); 
}


function closeConnection($connection){
	
	mysqli_close($connection);
}


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





//RESTAURANT TABLE FUNCTIONS

function executeRestaurantQuery($query){
	
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

function restNameQueryBuilder($userInput){
	
	$query = 	"SELECT * FROM restaurant
			    RIGHT JOIN location ON restaurant.LocID = location.LocID
				RIGHT JOIN category ON restaurant.CategoryID = category.CategoryID
				WHERE RestName LIKE" . "'%" . $userInput . "%'";
										
	return $query;
}





//LOCATION TABLE FUNCTIONS

function executeLocationQuery($query){
	
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
}


function locationQueryBuilder($longitude, $latitude, $searchRadius){
				
	$query = 
	
	"SELECT * FROM location
	LEFT JOIN restaurant ON location.LocID = restaurant.LocID
	RIGHT JOIN category ON restaurant.CategoryID = category.CategoryID
	WHERE(ST_Distance_Sphere
	(point(Longitude, Latitude),
	point(" . "'" . $longitude . "', '" . $latitude . "'))
	* .000621371192) <= " . "'" . $searchRadius . "'";
												 
	return $query;
}





//CATEGORY TABLE FUNCTIONS

function executeCategoryQuery($query){
	
	// Creating & storing a database connection
	$connection = createConnection();
	
	// Checks to see if a connection exists
	if(testConnection($connection)){
		
	// Run MySQL query and store the results as an array of records
	$results = mysqli_query($connection, $query);

	// If there are results..
	if(mysqli_num_rows($results) > 0){
	
		// Fetch data (Loops through an array of results)
		while($row = mysqli_fetch_assoc($results)){
		
			// Format and display results
			echo( 
					"CategoryID: " . $row["CategoryID"] . "  " .
					"Category: " . $row["Category"] . "<br>"  );
		}
	}
	else
	{ 	// No results from query error message
		echo ("No results found.. <br>"); 
	}

	// Closes current database connection
	closeConnection($connection);
	
	return $results;
	}
}





//DISPLAY FUNCTIONS

function echoResults($results){
					
	// If there are results..
	if(mysqli_num_rows($results) > 0){
	
		// Fetch data (Loops through an array of results)
		while($row = mysqli_fetch_assoc($results)){
					
			// Format and display results
			echo( 
					
					
					// restaurant data
					"RestID: " . $row["RestID"] . "  " .
					"RestName: " . $row["RestName"] . "  " .
					"PricePoint: " . $row["PricePoint"] . "  " .
					"Rating: " . $row["Rating"] .  "  " .
					"PhoneNumber: " . $row["PhoneNumber"] . "  " .
					"URL: " . $row["URL"] . "<br>" .
					
					// restaurant's category data
					"CategoryID: " . $row["CategoryID"] . "  " .
					"Category: " . $row["Category"] . "<br>" .					
							
					// restaurant's location data
					"LocID: " . $row["LocID"] . "  " .
					"ZipCode: " . $row["ZipCode"] . "  " .
					"Address: " . $row["Address"] . "  " .
					"City: " . $row["City"] . "  " .
					"State: " . $row["State"] .  "  " .
					"Latitude: " . $row["Latitude"] . "  " .
					"Longitude: " . $row["Longitude"] . "<br />&nbsp;<br />");
		}
	}
	else{ echo ("No results found.. <br>"); }
} 

?>