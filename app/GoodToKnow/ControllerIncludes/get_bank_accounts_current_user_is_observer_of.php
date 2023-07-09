<?php


use GoodToKnow\Models\bank_account_observer;
use GoodToKnow\Models\banking_acct_for_balances;


global $g;


/**
 * Get the banking_acct_for_balances objects which corresponding with the
 * bank_account_observer objects which have the current user as the observer.
 */

$sql = 'SELECT * FROM `bank_account_observer` WHERE `observer_id` = "' . $g->db->real_escape_string((string)$g->user_id) . '"';

$array_of_bank_account_observer = bank_account_observer::find_by_sql($sql);


/**
 * Add to $g->array_of_objects (which was retrieved earlier and should
 * already have the user owned bank accounts) the bank accounts which
 * the current user is an observer of.
 */

if ($array_of_bank_account_observer) {

    foreach ($array_of_bank_account_observer as $key => $observer_object) {

        $temp[$key] = banking_acct_for_balances::find_by_id($observer_object->account_id);
        if (!$temp[$key]) breakout(" Fatal error 221965. ");

        if ($temp[$key]->visibility == 'show') {
            $g->array_of_objects[] = $temp[$key];
        }

    }
    
}

