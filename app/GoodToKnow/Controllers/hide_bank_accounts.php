<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;

class hide_bank_accounts
{
    function page()
    {
        /**
         * Show form with checkboxes. Each checkbox represents a bank account which
         * is not hidden. This makes it possible for the user to select which bank
         * accounts he wants to make hidden.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get all the banking_acct_for_balances records which are not hidden.
         */

        get_db();

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "'
            . $g->db->real_escape_string($g->user_id) . "\" AND `visibility` = 'show'";

        $g->array_of_objects = banking_acct_for_balances::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any visible banking acct for balances. ');

        }

        /**
         * Present the form.
         */

        $g->html_title = 'Hide Bank Accounts';

        require VIEWS . DIRSEP . 'hidebankaccounts.php';
    }
}