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
        global $currency_transacted;
        global $commodity_amount;
        global $commodity_type;
        global $commodity_label;
        global $tax_year;
        global $profit;


        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * Start formulating the CommoditySold object so we can save it.
         */

        $array = ['user_id' => $g->user_id, 'time_bought' => $g->time_bought, 'time_sold' => $g->time_sold,
            'price_bought' => $g->price_bought, 'price_sold' => $g->price_sold, 'currency_transacted' => $currency_transacted,
            'commodity_amount' => $commodity_amount, 'commodity_type' => $commodity_type,
            'commodity_label' => $commodity_label, 'tax_year' => $tax_year, 'profit' => $profit];

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