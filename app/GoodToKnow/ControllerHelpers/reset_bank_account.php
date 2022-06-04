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

    if ($difference <= 3283200) return;


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

        /**
         * Then start_time should be set to $reset->start_time and start_balance should not be changed.
         */

        $account->start_time = $reset->start_time;

        $result = $account->save();

        if ($result === false) {

            breakout(' Err: 654323 I failed at saving the updated banking account for balances. ');

        }

        return;

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


    /**
     * Keep adjusting upwards by 1 second the $reset->start_time
     * until it is not equal to any of the transaction time values
     * in $array of transactions.
     */

    while (found_same_time_in_a_transaction($reset->start_time, $array)) {

        $reset->start_time++;

    }


    /**
     * Now we know:
     *  - $array has at least one transaction object.
     *  - $reset->start_time is not the same time value as found in any of the transaction time values.
     *
     * Now, we have the final value for $reset->start_time.
     * Now, we need to figure out what the $reset->start_balance is to be.
     *
     * Ideally, $reset->start_balance should be made equal to
     * the transaction balance of the last transaction before
     * $reset->start_time.
     *
     * Q: But, what if there are no transactions in $array which
     *    come before $reset->start_time?
     * A: Then, $reset->start_balance should be set to $account->start_balance.
     */

    if (there_are_no_transactions_before_reset_start_time($reset->start_time, $array)) {

        $reset->start_balance = $account->start_balance;

    } else {

        $reset->start_balance = the_balance_of_last_transaction_before_reset_start_time($reset->start_time, $array);

    }


    /**
     * Update the bank account record in the database.
     */

    $account->start_time = $reset->start_time;

    $account->start_balance = $reset->start_balance;

    $result = $account->save();

    if ($result === false) {

        breakout(' Err: 474383 I failed at saving the updated banking account for balances. ');

    }

}


/**
 * @param int $start_time
 * @param array $array
 * @return float
 */
function the_balance_of_last_transaction_before_reset_start_time(int $reset_start_time, array $array): float
{
    $key_of_last_transaction_before_start_time = 0;

    foreach ($array as $key => $value) {

        if ($value->start_time < $reset_start_time) {
            $key_of_last_transaction_before_start_time = $key;
        } else {
            break;
        }
    }

    return $array[$key_of_last_transaction_before_start_time]->balance;
}


/**
 * @param int $start_time
 * @param array $array
 * @return bool
 */
function there_are_no_transactions_before_reset_start_time(int $start_time, array $array): bool
{
    foreach ($array as $transaction) {

        if ($transaction->time < $start_time) return false;

    }

    return true;
}


/**
 * @param int $start_time
 * @param array $array
 * @return bool
 */
function found_same_time_in_a_transaction(int $start_time, array $array): bool
{
    foreach ($array as $transaction) if ((int)$transaction->time == $start_time) return true;

    return false;
}