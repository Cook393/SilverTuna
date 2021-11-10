<?php

//SESSION DATA GETTER

	//gets the current session query data, executes it, and returns the result
	function getSessionData(){

		if(isset($_SESSION["query"])){ $query = $_SESSION["query"]; }
		else{ echo("Return to the Home Page and start by searching for restaurants near you!"); }
		
		$data = executeQuery($query);
		
		return $data;
	}

//JSON ENCODE
	
	//accepts a restaurant object and echos it as a sortable HTML list item
	function encodeData($data){

		$array = array();

		while ($row = mysqli_fetch_assoc($data)){

			$array[] = $row;
		}
		
		return json_encode($array);
	}
?>