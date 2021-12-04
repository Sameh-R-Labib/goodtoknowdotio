<?php

namespace GoodToKnow\Controllers;

class FatherACommoditySold
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the commodities_sold table.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a Commodity Sold';


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['price_bought'] = '';
        $g->saved_arr01['price_sold'] = '';
        $g->saved_arr01['currency_transacted'] = '';
        $g->saved_arr01['commodity_amount'] = '';
        $g->saved_arr01['commodity_type'] = '';
        $g->saved_arr01['commodity_label'] = '';
        $g->saved_arr01['tax_year'] = '';
        $g->saved_arr01['profit'] = '';
        $g->saved_arr01['time_bought_date'] = '';
        $g->saved_arr01['time_bought_hour'] = '';
        $g->saved_arr01['time_bought_minute'] = '';
        $g->saved_arr01['time_bought_second'] = '';
        $g->saved_arr01['time_sold_date'] = '';
        $g->saved_arr01['time_sold_hour'] = '';
        $g->saved_arr01['time_sold_minute'] = '';
        $g->saved_arr01['time_sold_second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'fatheracommoditysold.php';
    }
}