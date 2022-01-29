<?php

use GoodToKnow\Models\Commodity;


global $g;


/**
 * Get an array of Commodity objects
 * belonging to the current user.
 */

$sql = 'SELECT * FROM `commodity` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '" ORDER BY `time` ASC';

$g->array_of_commodity_objects = Commodity::find_by_sql($sql);

if (!$g->array_of_commodity_objects || !empty($g->message)) {

    breakout(' I could NOT find any commodity records ¯\_(ツ)_/¯. ');

}

$g->html_title = 'Which commodity record?';