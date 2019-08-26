<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;

class PopulateABankingAccountForBalances
{
    function page()
    {
        /**
         * This feature is for editing/updating a BankingAcctForBalances record.
         *
         * This route is for presenting a form for getting the user to tell us which BankingAcctForBalances
         * record he wants to edit. It will present a series of radio buttons to choose from.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = get_db();


        /**
         * Get an array of BankingAcctForBalances objects belonging to the current user.
         */

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {
            breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which banking_acct_for_balances record?';

        require VIEWS . DIRSEP . 'populateabankingaccountforbalances.php';
    }
}