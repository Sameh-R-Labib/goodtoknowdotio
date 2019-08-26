<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;

class CheckMyBankingAccountTxBalances
{
    function page()
    {
        /**
         * About this feature:
         *  CheckMyBankingAccountTxBalances is a feature for  showing you a ledger with balances for one of
         *  your banking accounts and its transactions.
         *
         * About this function:
         *  It will present to you a selection of your banking  accounts so you can choose one.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        kick_out_loggedoutusers();

        $db = get_db();


        /**
         * Get an array of BankingAcctForBalances objects belonging to the current user.
         */

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {
            breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which banking account for balances?';

        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalances.php';
    }
}