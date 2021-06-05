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


        global $gtk;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Create a Taxable Income Event';


        require VIEWS . DIRSEP . 'startataxableincomeevent.php';
    }
}