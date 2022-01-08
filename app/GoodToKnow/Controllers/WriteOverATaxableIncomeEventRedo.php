<?php

namespace GoodToKnow\Controllers;

class WriteOverATaxableIncomeEventRedo
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        $g->html_title = 'One chance to redo';


        $g->action = '/ax1/WriteOverATaxableIncomeEventUpdate/page';
        $g->heading_one = 'Edit a Taxable Income Event';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'taxable_income_event_form.php';
    }
}