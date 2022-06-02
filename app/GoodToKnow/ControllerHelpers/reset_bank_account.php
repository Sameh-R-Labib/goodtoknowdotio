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
     * Make them reflect a point in the account's history which
     * is closer to time(). This reset account will update the
     * corresponding existing account in the database.
     */

}