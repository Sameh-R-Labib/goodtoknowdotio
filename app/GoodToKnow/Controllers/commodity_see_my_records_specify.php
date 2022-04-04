<?php

namespace GoodToKnow\Controllers;

class commodity_see_my_records_specify
{
    function page()
    {
        /**
         * Presents a form for entering:
         *  1. Name / type of commodity.
         *  2. Time Range.
         *
         * Q: Why are we doing this?
         * A: Because the goal is to enable the user to see a subset of his commodity records.
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


        $g->html_title = 'Specify Which Records';


        require VIEWS . DIRSEP . 'commodityseemyrecordsspecify.php';
    }
}