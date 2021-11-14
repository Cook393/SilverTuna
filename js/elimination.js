//DATA
	
	var counter = 0;
	const main = document.getElementById("main");


//EVENT LISTENERS
	
	//on click event to execute elimination engine
	document.getElementById("submitButton").addEventListener("click", function(){
    	
    	renderEliminationHTML();
    	requestData();
    	connectSortables();
	});


//JQUERY SORTABLES

	//--->JQuery Sortables API Documentation: https://api.jqueryui.com/sortable/

	//connects lists to sortable classes for drag and drop
	function connectSortables(){

		$(function(){$("#results").sortable({connectWith:"#trash, #keep"})});

		$(function(){$("#trash").sortable()});

		$(function(){$("#keep").sortable()});

		//listener for a restaurant being removed from the center ul
		$("#results").on("sortremove", function(event, ui){ requestData(); });
	}


//AJAX REQUEST

	// ---> AJAX tutorial: https://www.youtube.com/watch?v=rJesac0_Ftw&t=1591s&ab_channel=LearnWebCode

	//creates an ajax request and displays the current response
	function requestData(){

		//create request
		var request = new XMLHttpRequest();

		//specify and open request
		request.open("GET", "../json/results.json");

		request.onload = function(){

			//get reponseText and parse to readable json object
			var data = JSON.parse(request.responseText);

			//display dynamic html on request load
			renderRestaurantHTML(data);
		};

		//send XMLHttpRequest
		request.send();
	}


//DYNAMIIC HTML

	//writes DOM elements needed to display the elimination feature
	function renderEliminationHTML(){

		//empty elements from main
		main.innerHTML="";

		//create template literal for DOM elements
		var htmlString =

			`
			<div class="wrapper">
				<div class="left">
					<ul class="sortable" id="trash"></ul>
				</div>
				<div class="center">
					<ul class="sortable" id="results"></ul>
				</div>
				<div class="right">
					<ul class="sortable" id="keep"></ul>
				</div>
				<div style="clear: both"></div>
			</div>
			`

		//write template to main content
		main.innerHTML = htmlString;

		//edit wrapper style
		var wrapper = $(".wrapper"); 
	  	wrapper.css("z-index", "0");
	}

	//writes DOM elements needed to display restaurants
	function renderRestaurantHTML(data){

		//current "results.json" file data
		var length = data.length;
		
		//loop through json array
		if(counter < length){

			//create template literal for DOM elements
		  	var htmlString =

			  	`
			  	<li class="ui-state-default">
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

		  	//edit the inner HTML of results list
		  	var results = document.getElementById("results");
		  	results.innerHTML = htmlString;

		  	//increment counter
		  	counter++;
		}
		else{ renderFinalResults(); }
	}

	//final display function
	function renderFinalResults(){

		//find and remove results list and center div elements
		$("#results").remove();
		$(".center").remove();

		//remove and add a class to left div element
		var left = $(".left");
		left.removeClass("left");
		left.addClass("ourPick");

		//remove and add a class to right div element
		var right = $(".right");
		right.removeClass("right");
		right.addClass("topChoices");

		//find keep list, disable sortability, make it visisble, and insert heading
		var keep = $("#keep");
		keep.sortable("disable");
		keep.css("visibility", "visible");
		keep.css("overflow", "auto");

		//find trash list, empty it, disable sortability, and make it visible
		var trash = $("#trash");
		trash.empty();
		trash.sortable("disable");
		trash.css("visibility", "visible");

		renderHeadingHTML();

		//clone a random list item and add it as our pick
		var clone = getRandomClone();
		trash.append(clone);
	}


	//writes DOM elements needed to display final results headings
	function renderHeadingHTML(){

		//create template literal for DOM elements
		var htmlString = "";

		var length = document.querySelectorAll("#keep li").length;

		//render list headings based on number of elements in keep list
		if(length >= 2){

			htmlString +=
				`
			    <div>
					<h2 style="float:left; width: 52%; align-items: center; justify-content: center; display: flex;">Our Pick</h2>
					<h2 style="float:right; width: 42%; align-items: center; justify-content: center; display: flex;">Other Top Picks</h2>
				</div>
				<div style="clear: left"></div>
				`
		}
		else if(length == 1){ 

			htmlString +=
				`
			    <div>
					<h2 style="float:left; width: 52%; align-items: center; justify-content: center; display: flex;">Our Pick</h2>
				</div>
				<div style="clear: left"></div>
				`
		}
		else{

			htmlString +=
				`
				<h1>No results found..</h1>
				`
		}

		//add a div for headings before wrapper div
		if(htmlString != ""){ $(htmlString).insertBefore(".wrapper"); }
	}


//MATH FUNCTIONS

	//clone random list item
	function getRandomClone(keep){

		var length = document.querySelectorAll("#keep li").length
		const random = Math.floor(Math.random() * length) + 1;
		var clone = $("#keep li:nth-child("+random+")");

	  	return clone;
	}