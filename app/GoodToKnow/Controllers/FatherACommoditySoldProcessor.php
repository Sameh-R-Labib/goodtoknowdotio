<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommoditySold;

class FatherACommoditySoldProcessor
{
    function page()
    {
        /**
         * Create a database record in the commodities_sold table using the submitted commodities_sold data.
         */


        global $db;
        global $g;


        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * Start formulating the CommoditySold object so we can save it.
         */

        $array = ['user_id' => $g->user_id, 'time_bought' => $g->time_bought, 'time_sold' => $g->time_sold,
            'price_bought' => $g->price_bought, 'price_sold' => $g->price_sold, 'currency_transacted' => $g->currency_transacted,
            'commodity_amount' => $g->commodity_amount, 'commodity_type' => $g->commodity_type,
            'commodity_label' => $g->commodity_label, 'tax_year' => $g->tax_year, 'profit' => $g->profit];

        $object = CommoditySold::array_to_object($array);

        $db = get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' The save method for CommoditySold returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The save method for CommoditySold did not return false but it did send
            back a message. Therefore, it probably did not create the CommoditySold record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' Your new commodity sold has just been created 👍🏿 ');
    }
}