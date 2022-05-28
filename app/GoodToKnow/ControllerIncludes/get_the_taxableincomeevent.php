<?php

use GoodToKnow\Models\taxable_income_event;


global $g;


/**
 * 1) Store the submitted taxable_income_event id in the session.
 */

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 815113: taxable_income_event id is either not int or is negative int. ');

}

$_SESSION['saved_int01'] = $g->id;


/**
 * 2) Retrieve the taxable_income_event object with that id from the database.
 */

$g->object = taxable_income_event::find_by_id($g->id);

if (!$g->object) {

    breakout(' Unexpectedly, I could not find that taxable income event. ');

}


/**
 * 3) Make sure the object belongs to the user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 90703010. ');

}
