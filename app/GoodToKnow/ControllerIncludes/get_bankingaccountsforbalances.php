<?php

use GoodToKnow\Models\BankingAcctForBalances;


global $g;


/**
 * Get an array of BankingAcctForBalances objects belonging to the current user.
 */

$sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

$g->array_of_objects = BankingAcctForBalances::find_by_sql($sql);

if (!$g->array_of_objects || !empty($g->message)) {

    breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');

}