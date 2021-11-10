<?php

class Query{

//DATA

	private $query;


//GETTER

	public function getQuery(){ return $this->query; }


//SETTER

	//SELECT restaurants within search radius, join associated tables, set query
	public function setQuery($longitude, $latitude, $radius){
						
		$query = 	"SELECT
					rest.RestID, rest.RestName, rest.CategoryID, rest.LocID, rest.PricePoint, rest.Rating, rest.PhoneNumber, rest.URL,
					loc.ZipCode, loc.Address, loc.City, loc.State, loc.Latitude, loc.Longitude,
					cat.Category, cat.image
					FROM location loc
					LEFT JOIN restaurant rest ON loc.LocID = rest.LocID
					RIGHT JOIN category cat ON rest.CategoryID = cat.CategoryID
					WHERE(ST_Distance_Sphere
					(point(loc.Longitude, loc.Latitude),
					point(" . "'" . $longitude . "', '" . $latitude . "'))
					* .000621371192) <= " . $radius;									 
		
		$this->query = $query;
	}


//APPEND FUNCTIONS

	//AND LIKE %$restName%
	public function andRestName($restName){ $this->query=$this->query . " AND rest.RestName LIKE" . "'%" . $restName . "%'"; }

	//AND $category
	public function andCategory($category){ $this->query=$this->query . " AND (cat.Category= " . "'" . $category . "'"; }

	//OR $category
	public function orCategory($category){ $this->query=$this->query . " OR cat.Category= " . "'" . $category . "'";}

	//AND BETWEEN $min AND $max pricepoint
	public function betweenPricePoints($min, $max){ $this->query=$this->query . " AND rest.PricePoint BETWEEN " . $min . " AND " . $max; }

	//AND greater than or equal to $rating
	public function andRating($rating){ $this->query=$this->query . " AND rest.Rating >= " . "'" . $rating . "'"; }

	//ORDER BY $columnName ASC
	public function orderBy($columnName){ $this->query=$this->query . " ORDER BY " . $columnName . " ASC"; }

	//appends a parentheses to the end of the query
	public function addParentheses(){ $this->query=$this->query . ") "; }

}
?>