<?php


global $g;

/**
 * $g->id is topic id which user chose.
 */


if (!array_key_exists($g->id, $g->special_topic_array)) {

    breakout(' Unexpected error 18391: topic id not found in topic array. ');

}


$_SESSION['saved_int01'] = $g->id;
