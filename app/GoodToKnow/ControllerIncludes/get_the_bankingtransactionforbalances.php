<?php

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


/**
 * 1) Store the submitted banking_transaction_for_balances record id in the session.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
 */

$g->object = BankingTransactionForBalances::find_by_id($chosen_id);

if (!$g->object) {

    breakout(' Unexpectedly I could not find that banking transaction for balances. ');

}


/**
 * 3) Make sure the object belongs to the user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 68804579. ');

}
