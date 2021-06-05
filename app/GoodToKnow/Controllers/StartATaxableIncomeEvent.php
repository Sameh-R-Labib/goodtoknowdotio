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


        global $app_state;


        kick_out_loggedoutusers();


        $app_state->html_title = 'Create a Taxable Income Event';


        require VIEWS . DIRSEP . 'startataxableincomeevent.php';
    }
}