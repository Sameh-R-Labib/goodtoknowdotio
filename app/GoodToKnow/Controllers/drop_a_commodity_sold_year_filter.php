<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class drop_a_commodity_sold_year_filter
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_tax_year_and_its_commodities_sold.php';


        /**
         * Format for readability.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($g->array as $item) {

            $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);

        }


        $g->html_title = 'Which Commodity Sold?';

        require VIEWS . DIRSEP . 'dropacommoditysoldyearfilter.php';
    }
}