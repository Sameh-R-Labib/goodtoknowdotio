<?php

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $sessionMessage;

global $user_id;

kick_out_loggedoutusers();

kick_out_onabort();


/**
 * 1) Store the submitted banking_transaction_for_balances record id in the session.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
 */

$db = get_db();

$object = BankingTransactionForBalances::find_by_id($db, $sessionMessage, $chosen_id);

if (!$object) {

    breakout(' Unexpectedly I could not find that banking transaction for balances. ');

}


/**
 * 3) Make sure the object belongs to the user.
 */

if ($object->user_id != $user_id) {

    breakout(' Error 68804579. ');

}


/**
 * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
 * Instead we derive an array called $time from it and use $time to pr-populate the following fields:
 * date, hour, minute, second.
 */

require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

$time = get_date_h_m_s_from_a_timestamp($object->time);
