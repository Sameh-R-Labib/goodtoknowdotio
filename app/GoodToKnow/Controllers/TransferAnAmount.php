<?php

namespace GoodToKnow\Controllers;

class TransferAnAmount
{
    function page()
    {
        /**
         * Transfer An Amount
         * ==================
         *
         * Transfer An Amount makes it convenient to record the two transactions
         * involved when a single amount is transferred from one bank account to
         * another.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Enter Transfer Data';


        require VIEWS . DIRSEP . 'transferanamount.php';
    }
}