<?php

namespace GoodToKnow\Controllers;

class gawk_at_all_taxable_income_events
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_received value to be used
         * so that the subsequent code can display the taxable_income_event(s/plural) for that year.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'gawkatalltaxableincomeevents.php';
    }
}