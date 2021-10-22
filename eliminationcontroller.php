<?php

//LOCAL DATA


//SESSION DATA

function getSessionResults(){

	if(isset($_SESSION["query"])){
		
		$query = $_SESSION["query"]; 
	}
	else{ echo("You must search for local restaurants!"); }
	
	$results = executeQuery($query);
	
	return $results;
}


//DISPLAY FUNCTIONS

// test function for formatting user search results
function echoListItem($results){
	
	// If there are results..
	if(mysqli_num_rows($results) > 0){
		
		// Fetch data (Loops through an array of results)
		while($row = mysqli_fetch_assoc($results)){
			
			// Format and display results
			echo("<li class=\"ui-state-default\">" .

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
				 </table>".	

				"</li>"
			);
		}
	}
}
?>