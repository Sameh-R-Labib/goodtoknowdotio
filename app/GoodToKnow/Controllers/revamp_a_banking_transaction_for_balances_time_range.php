<?php

namespace GoodToKnow\Controllers;

class revamp_a_banking_transaction_for_balances_time_range
{
    function page(string $s = 'none')
    {
        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         * 2) Calculate the min and max times of the requested range.
         * 3) Store the min and max in session variables.
         * 4) Redirect.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->s = $s;


        require CONTROLLERINCLUDES . DIRSEP . 'find_min_max_time_range_based_on_choice.php';


        redirect_to("/ax1/revamp_a_banking_transaction_for_balances_choose_record/page");
    }
}