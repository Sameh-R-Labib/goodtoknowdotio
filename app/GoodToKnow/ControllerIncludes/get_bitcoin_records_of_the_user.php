<?php

use GoodToKnow\Models\Bitcoin;


global $app_state;
global $db;
global $array_of_bitcoin_objects;


kick_out_loggedoutusers();


$db = get_db();


/**
 * Get an array of Bitcoin objects
 * belonging to the current user.
 */

$sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $db->real_escape_string($app_state->user_id) . '"';

$array_of_bitcoin_objects = Bitcoin::find_by_sql($sql);

if (!$array_of_bitcoin_objects || !empty($app_state->message)) {

    breakout(' I could NOT find any bitcoin records ¯\_(ツ)_/¯. ');

}

$app_state->html_title = 'Which bitcoin record?';