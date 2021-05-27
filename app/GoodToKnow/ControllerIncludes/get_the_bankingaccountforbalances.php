<?php

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $db;
global $object;
global $sessionMessage;
global $user_id;


kick_out_loggedoutusers();


/**
 * 1) Store the submitted banking_acct_for_balances record id in the session.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * 2) Retrieve the banking_acct_for_balances object with that id from the database.
 */

$db = get_db();

$object = BankingAcctForBalances::find_by_id($chosen_id);

if (!$object) {

    breakout(' Unexpectedly I could not find that banking account for balances. ');

}


/**
 * 3) Make sure this object belongs to the user.
 */

if ($object->user_id != $user_id) {

    breakout(' Error 15450232. ');

}
