<?php


global $g;


/**
 * Determine the id of the bank_account_observer record from $id and
 * stores it in $_SESSION['saved_int01'].
 */

use GoodToKnow\Models\bank_account_observer;

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 52452: bank_account_observer id is either not int or is less than one. ');

}

$_SESSION['saved_int01'] = $g->id;


/**
 * Retrieve the bank_account_observer object with that id from the database.
 */

$g->object = bank_account_observer::find_by_id($g->id);

if (!$g->object) {

    breakout(' Unexpectedly I could not find that bank account observer. ');

}


/**
 * 3) Make sure this object belongs to the user.
 */

if ($g->object->owner_id != $g->user_id) {

    breakout(' Error 4345032. ');

}