<?php

namespace GoodToKnow\Controllers;

class generate_a_banking_account_for_balances_redo
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        $g->html_title = 'One chance to redo';


        $g->action = '/ax1/generate_a_banking_account_for_balances_processor/page';
        $g->heading_one = 'Create a Bank Account';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'banking_account_for_balances_form.php';
    }
}