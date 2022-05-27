<?php

use GoodToKnow\Models\recurring_payment;


global $g;


/**
 * 1) Determines the id of the recurring_payment record from 'choice' and stores it in $_SESSION['saved_int01'].
 */

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 22443: recurring_payment id is either not int or is negative int. ');

}

$_SESSION['saved_int01'] = $g->id;


/**
 * 2) Retrieve the recurring_payment object with that id from the database. And, format its attributes for easy viewing.
 */

$g->recurring_payment_object = recurring_payment::find_by_id($g->id);

if (!$g->recurring_payment_object) {

    breakout(' Unexpectedly I could not find that recurring payment. ');

}


/**
 *  3) Make sure this object belongs to the user.
 */

if ($g->recurring_payment_object->user_id != $g->user_id) {

    breakout(' Error 7783714. ');

}
