<?php

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $sessionMessage;

global $user_id;

kick_out_loggedoutusers();

kick_out_onabort();


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

$object = TaxableIncomeEvent::find_by_id($db, $sessionMessage, $id);

if (!$object) {

    breakout(' Unexpectedly, I could not find that taxable income event. ');

}


/**
 * 3) Make sure the object belongs to the user.
 */

if ($object->user_id != $user_id) {

    breakout(' Error 90703010. ');

}


/**
 * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
 * Instead we derive an array called $time from it and use $time to pr-populate the following fields:
 * date, hour, minute, second.
 */

require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

$time = get_date_h_m_s_from_a_timestamp($object->time);
