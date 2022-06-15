<?php


use GoodToKnow\Models\bank_account_observer;


global $g;


/**
 * Get an array of bank_account_observer objects where the current user owns the bank account.
 */

$sql = 'SELECT * FROM `bank_account_observer` WHERE `owner_id` = "' . $g->db->real_escape_string((string)$g->user_id) . '"';

$g->array_of_objects = bank_account_observer::find_by_sql($sql);

if (!$g->array_of_objects) {

    breakout(' I could NOT find any bank_account_observer objects where you are the owner ¯\_(ツ)_/¯. ');

}