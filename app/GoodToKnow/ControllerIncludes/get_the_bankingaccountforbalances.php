<?php

use GoodToKnow\Models\bank_account_observer;
use GoodToKnow\Models\banking_acct_for_balances;


global $g;


/**
 * 1) Store the submitted banking_acct_for_balances record id in the session.
 */

if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 5242822: banking_acct_for_balances id is either not int or is less than one. ');

}

$_SESSION['saved_int01'] = $g->id;


/**
 * 2) Retrieve the banking_acct_for_balances object with that id from the database.
 */

$g->object = banking_acct_for_balances::find_by_id($g->id);

if (!$g->object) {

    breakout(' Unexpectedly I could not find that banking account for balances. ');

}


/**
 * Is the current user an observer of this bank account?
 */

$is_observer_of_this_bank_account = false;

$sql = 'SELECT * FROM `bank_account_observer` WHERE `observer_id` = "' . $g->db->real_escape_string((string)$g->user_id) . '"';
$sql .= ' AND `account_id` = "' . $g->db->real_escape_string((string)$g->id) . '"';

$temp_observer_object = bank_account_observer::find_by_sql($sql);

if (!empty($temp_observer_object)) $is_observer_of_this_bank_account = true;


/**
 * 3) Make sure this object belongs to the user.
 */

if ($g->object->user_id != $g->user_id and !$is_observer_of_this_bank_account) {

    breakout(' Error 15450232. ');

}
