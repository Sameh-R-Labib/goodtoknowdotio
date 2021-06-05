<?php

namespace GoodToKnow\Controllers;

class GawkAtAllTaxableIncomeEvents
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_received value to be used
         * so that the subsequent code can display the taxable_income_event(s/plural) for that year.
         */


        global $gtk;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'gawkatalltaxableincomeevents.php';
    }
}