<?php

namespace GoodToKnow\Controllers;

class NukeATaxableIncomeEvent
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a TaxableIncomeEvent.
         *
         * This page is going to present a text box for entering a year_received to be used
         * to narrow down the choices for which taxable_income_event to delete.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'nukeataxableincomeevent.php';
    }
}