<?php

namespace GoodToKnow\Controllers;

class omit_a_banking_transaction_for_balances_time_range
{
    function page()
    {
        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         * 2) Calculate the min and max times of the requested range.
         * 3) Store the min and max in session variables.
         * 4) Redirect.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require CONTROLLERINCLUDES . DIRSEP . 'find_min_max_time_range_based_on_choice.php';


        redirect_to("/ax1/omit_a_banking_transaction_for_balances_choose_record/page");
    }
}