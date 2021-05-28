<?php

use GoodToKnow\Models\Bitcoin;


global $db;
global $sessionMessage;
global $array_of_bitcoin_objects;
global $user_id;            // We need this.
global $html_title;


kick_out_loggedoutusers();


$db = get_db();


/**
 * Get an array of Bitcoin objects
 * belonging to the current user.
 */

$sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

$array_of_bitcoin_objects = Bitcoin::find_by_sql($sql);

if (!$array_of_bitcoin_objects || !empty($sessionMessage)) {

    breakout(' I could NOT find any bitcoin records ¯\_(ツ)_/¯. ');

}

$html_title = 'Which bitcoin record?';