<?php

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $db;
global $gtk;
global $object;


kick_out_loggedoutusers();


/**
 * 1) Store the submitted taxable_income_event id in the session.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $id;


/**
 * 2) Retrieve the taxable_income_event object with that id from the database.
 */

$db = get_db();

$object = TaxableIncomeEvent::find_by_id($id);

if (!$object) {

    breakout(' Unexpectedly, I could not find that taxable income event. ');

}


/**
 * 3) Make sure the object belongs to the user.
 */

if ($object->user_id != $gtk->user_id) {

    breakout(' Error 90703010. ');

}
