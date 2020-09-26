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

        global $html_title;

        global $sessionMessage;

        global $user_id;

        global $timezone;

        kick_out_loggedoutusers();

        $db = get_db();

        require CONTROLLERHELPERS . DIRSEP . 'get_html_select_box_containing_the_bank_accounts.php';

        $account_type = get_html_select_box_containing_the_bank_accounts($db, $user_id, 0);

        $html_title = 'Create a Banking Transaction For Balances';

        require VIEWS . DIRSEP . 'buildabankingtransactionforbalances.php';
    }
}