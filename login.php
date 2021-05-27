<?php

$startDate = date("Y-m-d");

$futureDate=date('Y-m-d', strtotime('+10 year'));
$date = date_create_from_format('Y-m-d', $futureDate);


//echo $futureDate;
//echo $date;
echo gettype($startDate);

?>