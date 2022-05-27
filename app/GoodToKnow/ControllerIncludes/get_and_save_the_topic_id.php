<?php

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;

/**
 * $g->id is topic id which user chose.
 */


/**
 * Debug Code
 */
echo "\n<p>Begin debug</p>\n";
echo "<p>Var_dump \$g->id: </p>\n<pre>";
var_dump($g->id);
echo "</pre>\n";
echo "<p>Var_dump \$g->special_topic_array: </p>\n<pre>";
var_dump($g->special_topic_array);
echo "</pre>\n";
die("<p>End debug</p>\n");


if (!array_key_exists($g->id, $g->special_topic_array)) {

    breakout(' Unexpected error 18391: topic id not found in topic array. ');

}


$_SESSION['saved_int01'] = $g->id;
