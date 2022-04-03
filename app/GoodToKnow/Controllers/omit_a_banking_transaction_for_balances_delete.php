<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class omit_a_banking_transaction_for_balances_delete
{
    function page()
    {
        /**
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the banking_transaction_for_balances object
         *    and asks for approval for deletion to proceed.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingtransactionforbalances.php';


        /**
         * 4) Present a form (populated with data from the object)
         *    which asks for approval for deletion to proceed.
         *
         * Note: As usual we will pretty up the fields prior to showing them in the view.
         *       We will only show the following fields' values:
         *         - label
         *         - amount
         *         - time
         */

        /**
         * We need to know what the currency is. To do this we need the banking_acct_for_balances object.
         */

        $g->bank = banking_acct_for_balances::find_by_id($g->object->bank_id);

        if (!$g->bank) {

            breakout(' Unexpectedly I could not find that banking account for balances. ');

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        $g->object->time = get_readable_time($g->object->time);

        $g->object->amount = readable_amount_of_money($g->bank->currency, $g->object->amount);


        $g->html_title = 'Are you sure?';


        require VIEWS . DIRSEP . 'omitabankingtransactionforbalancesdelete.php';
    }
}