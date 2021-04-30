<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class DropACommoditySoldDelete
{
    function page()
    {
        /**
         *
         */

        global $html_title;

        global $object;

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_commodity_sold.php';


        /**
         * 4) Present a form which is populated with data from the commodities_sold object
         *    and asks for approval for deletion to proceed.
         *
         * We must format the fields to make them easier to read.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        // Make `time_bought` and `time_sold`

        $object->time_bought = get_readable_time($object->time_bought);

        $object->time_sold = get_readable_time($object->time_sold);


        // Make it so that if price_bought is fiat then price_bought has only two decimal places.

        $object->price_bought = readable_amount_of_money($object->currency_transacted, $object->price_bought);


        // Make it so that if price_sold is fiat then price_bought has only two decimal places.

        $object->price_sold = readable_amount_of_money($object->currency_transacted, $object->price_sold);


        // Make it so that if commodity_amount is fiat then commodity_amount has only two decimal places.

        $object->commodity_amount = readable_amount_of_money($object->commodity_type, $object->commodity_amount);


        // Make it so that if currency_transacted is fiat then profit has only two decimal places.

        $object->profit = readable_amount_of_money($object->currency_transacted, $object->profit);


        $html_title = 'Delete the commodity sold';

        require VIEWS . DIRSEP . 'dropacommoditysolddelete.php';
    }
}