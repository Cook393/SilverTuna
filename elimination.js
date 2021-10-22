$(function() { $("#results, #trash").sortable({connectWith: ".sortable"}).disableSelection();});

function clearTrash(){

	$("#clear").click(function() { $("#trash").empty();});
}