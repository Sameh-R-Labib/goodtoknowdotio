<?php

namespace GoodToKnow\Controllers;

class nuke_a_taxable_income_event
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a taxable_income_event.
         *
         * This page is going to present a text box for entering a year_received to be used
         * to narrow down the choices for which taxable_income_event to delete.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'nukeataxableincomeevent.php';
    }
}