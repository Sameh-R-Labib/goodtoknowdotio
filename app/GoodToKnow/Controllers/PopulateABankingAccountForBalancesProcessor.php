<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class PopulateABankingAccountForBalancesProcessor
{
    function page()
    {
        global $object;
        global $time;


        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Make sure this object belongs to the user.
         * 4) Present a form which is populated with data from the banking_acct_for_balances object.
         */


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * 4) Present a form which is populated with data from the banking_acct_for_balances object.
         */


        /**
         * Make it so that if price_point is fiat then price_point has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $object->start_balance = readable_amount_no_commas($object->currency, $object->start_balance);


        /**
         * This type of record has a field called `start_time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $time from it and use $time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        global $html_title;


        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time = get_date_h_m_s_from_a_timestamp($object->start_time);


        $html_title = 'Edit the banking_acct_for_balances record';


        require VIEWS . DIRSEP . 'populateabankingaccountforbalancesprocessor.php';
    }
}