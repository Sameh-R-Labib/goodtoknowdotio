<?php

use GoodToKnow\Models\BankingTransactionForBalances;


global $g;
global $db;
// $g->saved_int01 min time
// $g->saved_int02 max time


kick_out_loggedoutusers();


/**
 * Get an array of BankingTransactionForBalances objects belonging to the user and falling
 * within the prescribed time range.
 */

$db = get_db();

$sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = "' . $db->real_escape_string($g->user_id) . '"';
$sql .= ' AND `time` BETWEEN "' . $db->real_escape_string($g->saved_int01) . '" AND "' . $db->real_escape_string($g->saved_int02) . '"';
$sql .= ' ORDER BY `time`';

$g->array = BankingTransactionForBalances::find_by_sql($sql);

if (!$g->array || !empty($g->message)) {

    breakout(' I could NOT find any banking transaction for balances records ¯\_(ツ)_/¯ ');

}