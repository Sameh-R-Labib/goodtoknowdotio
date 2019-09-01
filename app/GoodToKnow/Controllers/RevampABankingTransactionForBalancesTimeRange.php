<?php

namespace GoodToKnow\Controllers;

class RevampABankingTransactionForBalancesTimeRange
{
    function page()
    {
        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         * 2) Calculate the min and max times of the requested range.
         * 3) Store the min and max in session variables.
         * 4) Redirect.
         */

        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require CONTROLLERINCLUDES . DIRSEP . 'find_min_max_time_range_based_on_choice.php';

        redirect_to("/ax1/RevampABankingTransactionForBalancesChooseRecord/page");
    }
}