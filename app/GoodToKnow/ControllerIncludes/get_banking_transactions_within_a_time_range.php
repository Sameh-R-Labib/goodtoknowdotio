<?php

use GoodToKnow\Models\BankingTransactionForBalances;


global $g;
// $g->saved_int01 min time
// $g->saved_int02 max time


/**
 * Get an array of BankingTransactionForBalances objects belonging to the user and falling
 * within the prescribed time range.
 */

$sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';
$sql .= ' AND `time` BETWEEN "' . $g->db->real_escape_string($g->saved_int01) . '" AND "' . $g->db->real_escape_string($g->saved_int02) . '"';
$sql .= ' ORDER BY `time`';

$g->array = BankingTransactionForBalances::find_by_sql($sql);

if (!$g->array || !empty($g->message)) {

    breakout(' I could NOT find any banking transaction for balances records ¯\_(ツ)_/¯ ');

}