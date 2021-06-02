<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class SpyCommoditiesSoldYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted tax_year.
         * 2) Present the CommoditySold(s/plural) in a page whose layout is similar to the Home page.
         */


        global $app_state;
        global $html_title;
        global $show_poof;
        global $page;
        global $array;


        require CONTROLLERINCLUDES . DIRSEP . 'get_tax_year_and_its_commodities_sold.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         *
         * Items which need this are:
         *   'time_bought', 'time_sold', 'price_bought', 'price_sold', 'commodity_amount', 'profit'.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        foreach ($array as $item) {
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

        $app_state->message .= " Here is one year's commodities sold records. ";

        $html_title = "One year's commodities sold records";

        $page = 'SpyCommoditiesSoldYear';

        $show_poof = true;

        require VIEWS . DIRSEP . 'spycommoditiessoldyearfilter.php';
    }
}