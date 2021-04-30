<?php

use GoodToKnow\Models\BankingAcctForBalances;

global $db;
global $array_of_objects;
global $sessionMessage;
global $user_id;            // We need this.

kick_out_loggedoutusers();

$db = get_db();

/**
 * Get an array of BankingAcctForBalances objects belonging to the current user.
 */

$sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

$array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);

if (!$array_of_objects || !empty($sessionMessage)) {
    breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');
}