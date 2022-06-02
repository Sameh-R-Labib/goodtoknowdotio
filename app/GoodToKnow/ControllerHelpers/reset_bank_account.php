<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\banking_acct_for_balances;

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

    if ($difference > 3283200) return;


    /**
     * Create an alternate account object called $reset.
     * $reset will store the values which I will later use
     * to update $account with.
     */

    $array_record = ['user_id' => $account->user_id, 'acct_name' => $account->acct_name, 'start_time' => $account->start_time,
        'start_balance' => $account->start_balance, 'currency' => $account->currency, 'comment' => $account->comment];

    $reset = banking_acct_for_balances::array_to_object($array_record);


    /**
     * Debug Code
     */
    echo "\n<p>Begin debug</p>\n";
    echo "<p>Var_dump \$account: </p>\n<pre>";
    var_dump($account);
    echo "</pre>\n";
    echo "<p>Var_dump \$reset: </p>\n<pre>";
    var_dump($reset);
    echo "</pre>\n";
    die("<p>End debug</p>\n");


    /**
     * Set $reset->start_time back 38 days from now.
     */

    $reset->start_time = time() - 3283200;

}