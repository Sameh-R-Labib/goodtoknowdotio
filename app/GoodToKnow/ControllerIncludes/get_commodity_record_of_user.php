<?php

use GoodToKnow\Models\commodity;


global $g;


/**
 * Determines the id of the commodity record and stores it in $_SESSION['saved_int01'].
 */

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 521113: Commodity id is either not int or is negative int. ');

}

$_SESSION['saved_int01'] = $g->id;


/**
 * Retrieve the commodity object with that id from the database.
 */

$g->commodity_object = commodity::find_by_id($g->id);

if (!$g->commodity_object) {

    breakout(' Unexpectedly I could not find that commodity record. ');

}


/**
 * Verify that this object belongs to the user.
 */

if ($g->commodity_object->user_id != $g->user_id) {

    breakout(' Error 8006667. ');

}
