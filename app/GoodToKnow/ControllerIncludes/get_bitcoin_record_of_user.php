<?php

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $sessionMessage;

kick_out_loggedoutusers();

kick_out_onabort();


/**
 * Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * Retrieve the Bitcoin object with that id from the database.
 */

$db = get_db();

$bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $chosen_id);

if (!$bitcoin_object) {

    breakout(' Unexpectedly I could not find that bitcoin record. ');

}


/**
 * Verify that this object belongs to the user.
 */

global $user_id;

if ($bitcoin_object->user_id != $user_id) {

    breakout(' Error 8006667. ');

}


/**
 * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
 * Instead we derive an array called $time from it and use $time to pr-populate the following fields:
 * date, hour, minute, second.
 */

require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

$time = get_date_h_m_s_from_a_timestamp($bitcoin_object->time);
