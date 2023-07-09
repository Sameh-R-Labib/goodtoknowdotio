<?php

namespace GoodToKnow\Controllers;

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
    }
}