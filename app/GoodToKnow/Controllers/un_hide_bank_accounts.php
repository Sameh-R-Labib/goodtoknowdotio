<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;

class un_hide_bank_accounts
{
    function page()
    {
        /**
         * Show form with checkboxes. Each checkbox represents a bank account which
         * is hidden. This makes it possible for the user to select which bank
         * accounts he wants to make shown.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get all the banking_acct_for_balances records which are hidden.
         */

        get_db();

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "'
            . $g->db->real_escape_string($g->user_id) . "\" AND `visibility` = 'hide'";

        $g->array_of_objects = banking_acct_for_balances::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any hidden banking acct for balances. ');

        }

        /**
         * Present the form.
         */

        $g->html_title = 'Un-hide Bank Accounts';

        require VIEWS . DIRSEP . 'unhidebankaccounts.php';
    }
}