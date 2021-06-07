<?php

namespace GoodToKnow\Controllers;

class WriteOverATaxableIncomeEvent
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_received value to be used to narrow down the
         * choices for which taxable_income_event to edit.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'writeoverataxableincomeevent.php';
    }
}