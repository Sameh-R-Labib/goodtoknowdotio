<?php

use GoodToKnow\Models\banking_acct_for_balances;


global $g;


/**
 * 1) Store the submitted banking_acct_for_balances record id in the session.
 */

$_SESSION['saved_int01'] = (int)$g->id;


/**
 * 2) Retrieve the banking_acct_for_balances object with that id from the database.
 */

$g->object = banking_acct_for_balances::find_by_id($g->id);

if (!$g->object) {

    breakout(' Unexpectedly I could not find that banking account for balances. ');

}


/**
 * 3) Make sure this object belongs to the user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 15450232. ');

}
