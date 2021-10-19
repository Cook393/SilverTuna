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
}
?>