<?php

namespace GoodToKnow\Controllers;

class process_a_commodity_sale
{
    function page()
    {
        /**
         * Process A Commodity Sale
         * ========================
         *
         * Process A Commodity Sale makes it convenient to both modify Commodity
         * records and create Capital Gain records when a user makes a sale
         * of a commodity at a point in time.
         *
         * If you understand how this is done manually you should be able to figure
         * out what this feature does. Just think of what kind of records you would
         * need to do capital gains tax reporting.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Because we are re-using the code for generating time fields we need this:
         */

        $g->saved_arr01['date'] = '';
        $g->saved_arr01['hour'] = '';
        $g->saved_arr01['minute'] = '';
        $g->saved_arr01['second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone


        $g->html_title = 'Process A Commodity Sale';


        require VIEWS . DIRSEP . 'processacommoditysale.php';
    }
}