<?php

use GoodToKnow\Models\possible_tax_deduction;


global $g;


/**
 * 1) Store the submitted possible_tax_deduction id in the session.
 */

$_SESSION['saved_int01'] = (int)$g->id;


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
