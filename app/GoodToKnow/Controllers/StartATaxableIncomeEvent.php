<?php

namespace GoodToKnow\Controllers;

class StartATaxableIncomeEvent
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the
         * taxable_income_event table.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Create a Taxable Income Event';


        require VIEWS . DIRSEP . 'startataxableincomeevent.php';
    }
}