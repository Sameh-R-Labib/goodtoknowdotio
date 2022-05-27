<?php

use GoodToKnow\Models\commodity_sold;


global $g;


/**
 * 1) Store the submitted commodities_sold id in the session.
 */

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 586113: Commodity id is either not int or is negative int. ');

}

$_SESSION['saved_int01'] = $g->id;


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
