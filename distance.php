<?php

// User Coordinates
$userLat = 43.06540887312966;
$userLong = -75.27437100599721;

// User Input Search Parameter
$distance = 30;


$query = "SELECT *, (((acos(sin((".$latitude."*pi()/180)) * sin((`Latitude`*pi()/180)) + cos((".$latitude."*pi()/180)) * cos((`Latitude`*pi()/180)) * cos(((".$longitude."- `Longitude`)*pi()/180)))) * 180/pi()) * 60 * 1.1515) as distance FROM `Location`` WHERE distance <= ".$distance."

?>