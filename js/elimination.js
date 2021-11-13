//DATA

	var counter = 0;
	var ul = document.getElementById("results");
	const button = document.getElementById("submit");


//EVENT LISTENERS

	//on load function
	window.onload = function(){ ProcessData(); }
	
	//SORTABLE LISTS

		// ---> JQuery Sortables API Documentation: https://api.jqueryui.com/sortable/

		$(function(){$("#results").sortable({connectWith:"#trash, #keep"})});

		$(function(){$("#trash").sortable()});

		$(function(){$("#keep").sortable()});

	//li removal listener
	$("#results").on("sortremove", function(event, ui){ ProcessData(); });


//AJAX REQUEST

	// ---> AJAX tutorial: https://www.youtube.com/watch?v=rJesac0_Ftw&t=1591s&ab_channel=LearnWebCode

	//creates an ajax request and displays the current response
	function processData(){

		var request = new XMLHttpRequest();
		request.open("GET", "../json/results.json");

		request.onload = function(){

			var data = JSON.parse(request.responseText);
			displayRestaurant(data);
		};

		request.send();
	}


//DYNAMIIC HTML

	//recieves ajax request data and adds the current restaurant to the page, or displays the final results
	function displayRestaurant(data){

		//current results.json data
		var length = data.length;
		
		//loop through json array
		if(counter < length){

			//create restaurant table in HTML
	  		htmlString = 

	  			//template literal

		  		`
		  		<li class="ui-state-default" id=\"${counter}\">
		  		<table border="1" bgcolor="white">
				<tr><td rowspan=\"3\"><img src=\" ${data[counter].image} \"></img></td>
				<td><h2> ${data[counter].RestName} </h2></td>
				<td><b> Rating:</b> ${data[counter].Rating} Stars</td</tr>
				<tr>
				<td><b> Category:</b> ${data[counter].Category} </td>
				<td><b> Average Dish Price:</b> ${data[counter].PricePoint} </td></tr>
				<tr>
				<td><b> Address:</b> ${data[counter].Address} ${data[counter].City} ${data[counter].State} ${data[counter].ZipCode} </td>
				<td><a href= \"${data[counter].URL}\">Website Link</a><br><b> Phone Number:</b> ${data[counter].PhoneNumber} </td>
				</tr>
				</table>
		  		`

		  	//change the inner HTML of results List
	  		ul.innerHTML = htmlString;
	  		counter++;
		}
		else{ displayFinalResults(); }
	}


	//final results display
	function displayFinalResults(){

		var topPicks = document.getElementById("right");
		topPicks.className = "topPicks";
		
		$("#trash").remove();
		$("#results").remove();
		$(".left").remove();
		$(".center").remove();

		var list = $("#keep")

		if(list.length > 0){ $("<h2>Top Choices</h2>").insertBefore(list); }

		const randomClone = cloneRandomLi();

		$(randomClone).insertBefore(topPicks);
		$("<h2>Our Pick</h2>").insertBefore(randomClone);
	}


	
	
	//clone random list item
	function cloneRandomLi(){

		var clone = $("#keep li:nth-child(1)");

	  	return clone;
	}