<?php

namespace GoodToKnow\Controllers;

class write_over_a_taxable_income_event
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_received value to be used to narrow down the
         * choices for which taxable_income_event to edit.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'writeoverataxableincomeevent.php';
    }
}