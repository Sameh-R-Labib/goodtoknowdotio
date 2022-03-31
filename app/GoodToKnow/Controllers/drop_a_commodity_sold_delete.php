<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class drop_a_commodity_sold_delete
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


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

        $g->object->time_bought = get_readable_time($g->object->time_bought);

        $g->object->time_sold = get_readable_time($g->object->time_sold);


        // Make it so that if price_bought is fiat then price_bought has only two decimal places.

        $g->object->price_bought = readable_amount_of_money($g->object->currency_transacted, $g->object->price_bought);


        // Make it so that if price_sold is fiat then price_bought has only two decimal places.

        $g->object->price_sold = readable_amount_of_money($g->object->currency_transacted, $g->object->price_sold);


        // Make it so that if commodity_amount is fiat then commodity_amount has only two decimal places.

        $g->object->commodity_amount = readable_amount_of_money($g->object->commodity_type, $g->object->commodity_amount);


        // Make it so that if currency_transacted is fiat then profit has only two decimal places.

        $g->object->profit = readable_amount_of_money($g->object->currency_transacted, $g->object->profit);


        $g->html_title = 'Delete the commodity sold';

        require VIEWS . DIRSEP . 'dropacommoditysolddelete.php';
    }
}