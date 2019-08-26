<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;

class AnnulABankingAcctForBalances
{
    function page()
    {
        /**
         * Presenting a form for getting the user to tell us
         * which BankingAcctForBalances record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         * Get an array of BankingAcctForBalances objects belonging to the current user.
         */

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {
            breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which banking_acct_for_balances?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalances.php';
    }
}