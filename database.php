<?php

// Connection data
$servername = "localhost";
$username = "root";
$password = "";
$database = "silvertuna";

// Creates and returns a database connection
function createConnection(){
	
	global $servername;
	global $username;
	global $password;
	global $database;
	
	return $connection = mysqli_connect($servername, $username, $password, $database); 
}

// Closes current database connection
function closeConnection($connection){
	
	mysqli_close($connection);
}

// Returns boolean and echos reponse message based on connection result
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

// Accepts a string query on the 'restaurant' Table and returns the results
function executeRestaurantQuery($query){
	
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
					"RestID: " . $row["RestID"] . "  " .
					"RestName: " . $row["RestName"] .  "  " .
					"CategoryID: " . $row["CategoryID"] . "  " .
					"LocID: " . $row["LocID"] .  "  " .
					"PricePoint: " . $row["PricePoint"] . "  " .
					"Rating: " . $row["Rating"] . "<br>" );
		}
	}
	else
	{ 	// No results from query error message
		//echo ("No results found <br>"); 
	}

	// Closes current database connection
	closeConnection($connection);
	
	return $results;
	}
}

// Accepts a string query on the 'category' Table and returns the results
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

// Accepts a string query on the 'location' Table and returns the results
function executeLocationQuery($query){
	
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
					"LocID: " . $row["LocID"] . "  " .
					"ZipCode: " . $row["ZipCode"] . "  " .
					"City: " . $row["City"] . "  " .
					"State: " . $row["State"] .  "  " .
					"Latitude: " . $row["Latitude"] . "  " .
					"Longitude: " . $row["Longitude"] . "<br>"  );
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

?>