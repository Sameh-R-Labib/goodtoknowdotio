<?php

namespace GoodToKnow\Controllers;

class BuildABankingTransactionForBalancesRedo
{
    function page()
    {
        /**
         * This is similar to InduceATask::page().
         */

        global $g;

        kick_out_loggedoutusers_or_if_there_is_error_msg();

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';

        $g->html_title = 'One chance to redo';

        require VIEWS . DIRSEP . 'buildabankingtransactionforbalances.php';
    }
}