<?php

use GoodToKnow\Models\Bitcoin;


global $g;


kick_out_loggedoutusers();


$g->db = get_db();


/**
 * Get an array of Bitcoin objects
 * belonging to the current user.
 */

$sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

$g->array_of_bitcoin_objects = Bitcoin::find_by_sql($sql);

if (!$g->array_of_bitcoin_objects || !empty($g->message)) {

    breakout(' I could NOT find any bitcoin records ¯\_(ツ)_/¯. ');

}

$g->html_title = 'Which bitcoin record?';