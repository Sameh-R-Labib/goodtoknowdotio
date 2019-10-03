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

        /** @var $user_id */
        /** @var $time_bought */
        /** @var $time_sold */
        /** @var $price_bought */
        /** @var $price_sold */
        /** @var $currency_transacted */
        /** @var $commodity_amount */
        /** @var $commodity_type */
        /** @var $commodity_label */
        /** @var $tax_year */
        /** @var $profit */

        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * Start formulating the CommoditySold object so we can save it.
         */

        $array = ['user_id' => $user_id, 'time_bought' => $time_bought, 'time_sold' => $time_sold,
            'price_bought' => $price_bought, 'price_sold' => $price_sold, 'currency_transacted' => $currency_transacted,
            'commodity_amount' => $commodity_amount, 'commodity_type' => $commodity_type,
            'commodity_label' => $commodity_label, 'tax_year' => $tax_year, 'profit' => $profit];

        $object = CommoditySold::array_to_object($array);

        $db = get_db();

        $result = $object->save($db, $sessionMessage);

        if (!$result) {

            breakout(' The save method for CommoditySold returned false. ');

        }

        if (!empty($sessionMessage)) {

            breakout(' The save method for CommoditySold did not return false but it did send
            back a message. Therefore, it probably did not create the CommoditySold record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A Commodity Sold was created 👍🏿. ');
    }
}