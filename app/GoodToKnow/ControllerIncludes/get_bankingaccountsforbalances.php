<?php

use GoodToKnow\Models\BankingAcctForBalances;


global $db;
global $array_of_objects;
global $app_state;
global $user_id;            // We need this.


kick_out_loggedoutusers();


/**
 * Get an array of BankingAcctForBalances objects belonging to the current user.
 */

$db = get_db();

$sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

$array_of_objects = BankingAcctForBalances::find_by_sql($sql);

if (!$array_of_objects || !empty($app_state->message)) {

    breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');

}