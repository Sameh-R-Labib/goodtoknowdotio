<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class spy_commodities_sold_year_filter
{
    function page()
    {
        /**
         * 1) Validate the submitted tax_year.
         * 2) Present the commodity_sold(s/plural) in a page whose layout is similar to the home page.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_tax_year_and_its_commodities_sold.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         *
         * Items which need this are:
         *   'time_bought', 'time_sold', 'price_bought', 'price_sold', 'commodity_amount', 'profit'.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        foreach ($g->array as $item) {

            $item->time_bought = get_readable_time($item->time_bought);
            $item->time_sold = get_readable_time($item->time_sold);
            $item->price_bought = readable_amount_of_money($item->currency_transacted, $item->price_bought);
            $item->price_sold = readable_amount_of_money($item->currency_transacted, $item->price_sold);
            $item->profit = readable_amount_of_money($item->currency_transacted, $item->profit);
            $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);

        }


        /**
         * Prep the view.
         */

        $g->html_title = "One year's commodities sold records";

        $g->page = 'spy_commodities_sold_year_filter';

        $g->show_poof = true;

        $g->message .= " Here's one year of Commodity Sold. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'spycommoditiessoldyearfilter.php';
    }
}