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


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a Taxable Income Event';


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['year_received'] = '';
        $g->saved_arr01['currency'] = '';
        $g->saved_arr01['amount'] = '';
        $g->saved_arr01['price'] = '';
        $g->saved_arr01['fiat'] = '';
        $g->saved_arr01['comment'] = '';
        $g->saved_arr01['date'] = '';
        $g->saved_arr01['hour'] = '';
        $g->saved_arr01['minute'] = '';
        $g->saved_arr01['second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        $g->action = '/ax1/StartATaxableIncomeEventProcessor/page';
        $g->heading_one = 'Create a Taxable Income Event';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'taxable_income_event_form.php';
    }
}