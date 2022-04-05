<?php

use GoodToKnow\Models\banking_acct_for_balances;


global $g;


/**
 * Get an array of banking_acct_for_balances objects belonging to the current user.
 */

$sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $g->db->real_escape_string((string)$g->user_id) . '"';

$g->array_of_objects = banking_acct_for_balances::find_by_sql($sql);

if (!$g->array_of_objects) {

    breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');

}