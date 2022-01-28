<?php

namespace GoodToKnow\Controllers;

class CommoditySeeMyRecordsSpecify
{
    function page()
    {
        /**
         * Presents a form for entering:
         *  1. Name / type of commodity.
         *  2. Time Range.
         *
         * Q: Why are we doing this?
         * A: Because the goal is to enable the user to see a subset of his Commodity records.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Specify Which Records';


        require VIEWS . DIRSEP . 'commodityseemyrecordsspecify.php';
    }
}