<?php

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $db;
global $g;
global $recurring_payment_object;


kick_out_loggedoutusers();


/**
 * 1) Determines the id of the recurring_payment record from 'choice' and stores it in $_SESSION['saved_int01'].
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * 2) Retrieve the RecurringPayment object with that id from the database. And, format its attributes for easy viewing.
 */

$db = get_db();

$recurring_payment_object = RecurringPayment::find_by_id($chosen_id);

if (!$recurring_payment_object) {

    breakout(' Unexpectedly I could not find that recurring payment. ');

}


/**
 *  3) Make sure this object belongs to the user.
 */

if ($recurring_payment_object->user_id != $g->user_id) {

    breakout(' Error 7783714. ');

}
