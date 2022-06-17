<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class view_all_banking_accounts_for_balances
{
    function page()
    {
        /**
         * Similar to recurring_payment_see_my_records.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        // This flag helps with avoid a premature breakout() in get_bankingaccountsforbalances.php
        // when used in check_my_banking_account_tx_balances.
        $g->is_show_bank_account_transactions = false;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($g->array_of_objects as $object) {

            $object->start_time = get_readable_time($object->start_time);
            $object->comment = nl2br($object->comment, false);
            $object->start_balance = readable_amount_of_money($object->currency, $object->start_balance);

        }


        /**
         * Present the view.
         */

        $g->html_title = "Bank Account";

        $g->show_poof = true;

        $g->page = 'view_all_banking_accounts_for_balances';

        $g->message .= " Here are all your bank accounts. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'viewallbankingaccountsforbalances.php';
    }
}