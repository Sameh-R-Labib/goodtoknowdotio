<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\banking_acct_for_balances;
use GoodToKnow\Models\banking_transaction_for_balances;

/**
 * @param object $account
 * @return void
 */
function reset_bank_account(object $account)
{
    /**
     * Reset the start_time and start_balance of object $account.
     * Make start_time and start_balance reflect a point in the
     * account's history where start_time is closer to time().
     * This $reset version of $account will is used to update the
     * database record of $account.
     */


    global $g;


    /**
     * Stop if $account->start_time reflects a time which is less
     * than 38 days old.
     *
     * 38 days is 3283200 seconds.
     */

    $difference = time() - (int)$account->start_time;

    if ($difference < 3283200) return;


    /**
     * Create an alternate account object called $reset.
     * $reset will store the values which I will later use
     * to update $account with.
     */

    $array_record = ['user_id' => $account->user_id, 'acct_name' => $account->acct_name, 'start_time' => $account->start_time,
        'start_balance' => $account->start_balance, 'currency' => $account->currency, 'comment' => $account->comment];


    $reset = banking_acct_for_balances::array_to_object($array_record);


    /**
     * Set $reset->start_time back 38 days from now.
     */

    $reset->start_time = time() - 3283200;


    /**
     * At this point we have a preliminary start_time for the new record.
     * However, we do not want the start time to be the same time as any
     * of the transaction times.
     */


    /**
     * I want to get a set of transactions like the ones which would be
     * displayed when a user uses the feature named "See Transactions".
     * This set of transactions includes a running balance.
     *
     * The transactions should have field values which are the same as
     * their database records as opposed to being formatted for viewing.
     * Also, order them from oldest to newest.
     */

    $sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);
    $sql .= ' AND `bank_id` = ' . $g->db->real_escape_string((string)$account->id);
    $sql .= ' AND `time` > ' . $g->db->real_escape_string((string)$account->start_time);
    $sql .= ' ORDER BY `time` ASC';

    $array = banking_transaction_for_balances::find_by_sql($sql);

    if (!$array) {

        breakout(' Err: 66865 I could NOT find any bank account transactions ¯\_(ツ)_/¯ ');

    }

    // Augment our data set with a running total in each banking_transaction_for_balances
    // object. This gets assigned to each banking_transaction_for_balances object's balance field.

    $running_total = (float)$account->start_balance;

    foreach ($array as $transaction) {

        $running_total += (float)$transaction->amount;

        if (abs($running_total) >= 0.0000000000000001) {

            $transaction->balance = $running_total;

        } else {

            $transaction->balance = 0.0;

        }

    }

}