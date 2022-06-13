<?php

namespace GoodToKnow\Controllers;

class produce_a_bank_acct_observer
{
    function page()
    {
        /**
         * Create A Bank Account Observer
         * ==============================
         *
         * Q: What is a bank_account_observer?
         * A: A bank_account_observer is an object which specifies who
         *    can observe someone else's bank account object and its
         *    associated transactions.
         *
         * In this route we present a form so that the user can specify
         * the username of the observer.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();

        $g->html_title = 'Which user?';


        require VIEWS . DIRSEP . 'produceabankacctobserver.php';
    }
}