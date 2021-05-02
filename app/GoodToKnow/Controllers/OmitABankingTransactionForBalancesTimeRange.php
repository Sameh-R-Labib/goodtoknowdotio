<?php

namespace GoodToKnow\Controllers;

class OmitABankingTransactionForBalancesTimeRange
{
    function page()
    {
        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         * 2) Calculate the min and max times of the requested range.
         * 3) Store the min and max in session variables.
         * 4) Redirect.
         */


        kick_out_loggedoutusers();


        require CONTROLLERINCLUDES . DIRSEP . 'find_min_max_time_range_based_on_choice.php';


        redirect_to("/ax1/OmitABankingTransactionForBalancesChooseRecord/page");
    }
}