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


        /**
         * One reason we need to pass on the "to display message"
         * is that we are moving to the next route via the submission
         * of a form rather than by using the "redirect_to" function.
         * Another reason is that it is important for this feature to
         * carry all its messages to the end.
         */

        $_SESSION['message'] = $g->message;


        $g->html_title = 'Which year received?';


        require VIEWS . DIRSEP . 'gawkatalltaxableincomeevents.php';
    }
}