<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class PopulateABankingAccountForBalancesProcessor
{
    function page()
    {
        global $g;


        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Make sure this object belongs to the user.
         * 4) Present a form which is populated with data from the banking_acct_for_balances object.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->html_title = 'Edit the banking_acct_for_balances record';


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * 4) Present a form which is populated with data from the banking_acct_for_balances object.
         */


        /**
         * Make it so that if price_point is fiat then price_point has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $g->object->start_balance = readable_amount_no_commas($g->object->currency, $g->object->start_balance);


        /**
         * This type of record has a field called `start_time`. We are not going to pre-populate a form field with it.
         * Instead, we derive an array called $g->time from it and use $g->time to pre-populate the following fields:
         * date, hour, minute, second.
         */


        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $g->time = get_date_h_m_s_from_a_timestamp($g->object->start_time);


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['acct_name'] = $g->object->acct_name;
        $g->saved_arr01['start_balance'] = $g->object->start_balance;
        $g->saved_arr01['currency'] = $g->object->currency;
        $g->saved_arr01['comment'] = $g->object->comment;
        $g->saved_arr01['date'] = $g->time['date'];
        $g->saved_arr01['hour'] = $g->time['hour'];
        $g->saved_arr01['minute'] = $g->time['minute'];
        $g->saved_arr01['second'] = $g->time['second'];
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone


        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        $g->action = '/ax1/PopulateABankingAccountForBalancesSubmit/page';
        $g->heading_one = 'Edit a Bank Account for Ledger';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'banking_account_for_balances_form.php';
    }
}