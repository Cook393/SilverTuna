var counter = 0;
var ul = document.getElementById("results");
const button = document.getElementById("submit");

$(function(){$("#results").sortable({connectWith:"#trash, #keep"})});

$(function(){$("#trash").sortable()});

$(function(){$("#keep").sortable()});


//needs work, requests should be validated

window.onload = function(){

	var request = new XMLHttpRequest();
	request.open("GET", "../json/results.json");

	request.onload = function(){

		var data = JSON.parse(request.responseText);
		displayRestaurant(data);
	};

	request.send();
}

$("#results").on("sortremove", function(event, ui){

	var request = new XMLHttpRequest();
	request.open("GET", "../json/results.json");

	request.onload = function(){

		var data = JSON.parse(request.responseText);
		displayRestaurant(data);
	};

	request.send();
});

function displayRestaurant(data){

	var length = data.length;
			
	if(counter < length){

  		htmlString = 

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

  		ul.innerHTML = htmlString;
  		counter++;
	}
	else{ displayFinalResults(); }
}


//needs work
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


//getting random li needs work
function cloneRandomLi(){

	var clone = $("#keep li:nth-child(1)");
  	clone.className = "ourPick";

  	return clone;
}