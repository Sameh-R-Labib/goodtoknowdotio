<?php

namespace GoodToKnow\ControllerHelpers;

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


    /**
     * Stop if $account->start_time reflects a time which is less
     * than 38 days old.
     *
     * 38 days is 3283200 seconds.
     */

    $difference = time() - (int)$account->start_time;

    if ($difference > 3283200) return;


    /**
     *
     */

}