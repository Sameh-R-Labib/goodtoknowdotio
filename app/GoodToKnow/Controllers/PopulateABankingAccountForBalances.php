<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;


class PopulateABankingAccountForBalances
{
    public function page()
    {
        /**
         * This feature is for editing/updating
         * a BankingAcctForBalances record.
         *
         * This route is for presenting a
         * form for getting the user to tell us
         * which BankingAcctForBalances record he wants to edit.
         * It will present a series of radio
         * buttons to choose from.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Get an array of BankingAcctForBalances objects belonging to the current user.
         */
        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any banking_acct_for_balances records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which banking_acct_for_balances record?';

        require VIEWS . DIRSEP . 'populateabankingaccountforbalances.php';
    }
}