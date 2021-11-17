<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_html_select_box_containing_the_bank_accounts;

class BuildABankingTransactionForBalances
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the
         * banking_transaction_for_balances table.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERHELPERS . DIRSEP . 'get_html_select_box_containing_the_bank_accounts.php';

        $g->account_type = get_html_select_box_containing_the_bank_accounts($g->user_id, 0);


        $g->html_title = 'Create a Banking Transaction For Balances';


        require VIEWS . DIRSEP . 'buildabankingtransactionforbalances.php';
    }
}