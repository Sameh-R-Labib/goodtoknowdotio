<?php

namespace GoodToKnow\Controllers;

class father_a_commodity_sold_redo
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time values because we think they are wrong.</b> ';


        $g->html_title = 'One chance to redo';


        $g->action = '/ax1/father_a_commodity_sold_processor/page';
        $g->heading_one = 'Create a Commodity Sold Record';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'commodity_sold_form.php';
    }
}