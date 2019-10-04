<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class FineTuneACommoditySoldYearFilter
{
    function page()
    {
        /** @var $array */
        require CONTROLLERINCLUDES . DIRSEP . 'get_tax_year_and_its_commodities_sold.php';


        /**
         * Format for readability.
         */

        foreach ($array as $item) {
            $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);
        }


        $html_title = 'Which Commodity Sold?';

        require VIEWS . DIRSEP . 'finetuneacommoditysoldyearfilter.php';
    }
}