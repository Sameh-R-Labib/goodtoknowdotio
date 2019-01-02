<?php
$date = "01/02/2019";

$words = explode('/', $date);

$day = $words[1];
$month = $words[0];
$year = $words[2];

$timestamp = mktime(0, 0, 0, $month, $day, $year);

echo $timestamp;