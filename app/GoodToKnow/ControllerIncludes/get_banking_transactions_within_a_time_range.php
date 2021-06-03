<?php

use GoodToKnow\Models\BankingTransactionForBalances;


global $db;
global $app_state;
global $saved_int01;     // min time
global $saved_int02;     // max time
global $array;


kick_out_loggedoutusers();


/**
 * Get an array of BankingTransactionForBalances objects belonging to the user and falling
 * within the prescribed time range.
 */

$db = get_db();

$sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = "' . $db->real_escape_string($app_state->user_id) . '"';
$sql .= ' AND `time` BETWEEN "' . $db->real_escape_string($saved_int01) . '" AND "' . $db->real_escape_string($saved_int02) . '"';
$sql .= ' ORDER BY `time`';

$array = BankingTransactionForBalances::find_by_sql($sql);

if (!$array || !empty($app_state->message)) {

    breakout(' I could NOT find any banking transaction for balances records ¯\_(ツ)_/¯ ');

}