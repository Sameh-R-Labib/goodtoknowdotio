<?php

namespace GoodToKnow\Controllers;

class revamp_a_banking_transaction_for_balances
{
    function page()
    {
        /**
         * This page is going to present some radio buttons for answering the question of which
         * time range the user wants to see further choices of transactions for.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which time range for filtering your transaction choices?';


        require VIEWS . DIRSEP . 'revampabankingtransactionforbalances.php';
    }
}