<?php

use GoodToKnow\Models\possible_tax_deduction;


global $g;


/**
 * 1) Store the submitted possible_tax_deduction id in the session.
 */

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 2286113: possible_tax_deduction id is either not int or is negative int. ');

}

$_SESSION['saved_int01'] = $g->id;


/**
 * 2) Retrieve the possible_tax_deduction object with that id from the database.
 */

$g->object = possible_tax_deduction::find_by_id($g->id);

if (!$g->object) {

    breakout(' Unexpectedly, I could not find that possible tax deduction. ');

}


/**
 * 3) Make sure the object belongs to this user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 01544111. ');

}
