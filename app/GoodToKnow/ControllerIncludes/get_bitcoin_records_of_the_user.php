<?php

use GoodToKnow\Models\Bitcoin;


global $gtk;
global $db;
global $array_of_bitcoin_objects;


kick_out_loggedoutusers();


$db = get_db();


/**
 * Get an array of Bitcoin objects
 * belonging to the current user.
 */

$sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $db->real_escape_string($gtk->user_id) . '"';

$array_of_bitcoin_objects = Bitcoin::find_by_sql($sql);

if (!$array_of_bitcoin_objects || !empty($gtk->message)) {

    breakout(' I could NOT find any bitcoin records ¯\_(ツ)_/¯. ');

}

$gtk->html_title = 'Which bitcoin record?';