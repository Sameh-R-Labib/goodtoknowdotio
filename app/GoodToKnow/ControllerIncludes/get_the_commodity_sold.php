<?php

use GoodToKnow\Models\commodity_sold;


global $g;


/**
 * 1) Store the submitted commodities_sold id in the session.
 */

$_SESSION['saved_int01'] = (int)$g->id;


/**
 * 2) Retrieve the commodities_sold object with that id from the database.
 */

$g->object = commodity_sold::find_by_id($g->id);

if (!$g->object) {

    breakout(' Unexpectedly, I could not find that commodity sold. ');

}


/**
 * 3) Make sure the object belongs to this user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 01244161. ');

}
