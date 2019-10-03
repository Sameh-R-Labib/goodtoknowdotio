<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommoditySold;
use function GoodToKnow\ControllerHelpers\bitcoin_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class FatherACommoditySoldProcessor
{
    function page()
    {
        /**
         * Create a database record in the commodities_sold table using the submitted commodities_sold data.
         */

        global $sessionMessage;

        global $user_id;

        kick_out_loggedoutusers();


        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'bitcoin_address_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';


        /**
         * Get the $time_bought and $time_sold (which are timestamps) based on submitted:
         * `timezone` `time_bought_date` `time_bought_hour` `time_bought_minute` `time_bought_second`
         * `time_sold_date` `time_sold_hour` `time_sold_minute` `time_sold_second`
         */

        /** @var $time_bought */
        /** @var $time_sold */

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_bought_and_time_sold_epochs.php';


        /**
         * Get $price_bought
         */

        $price_bought = float_form_field_prep('price_bought', 0.0, 999999999999999.99);


        /**
         * Get $price_sold
         */

        $price_sold = float_form_field_prep('price_sold', 0.0, 999999999999999.99);


        /**
         * Get $currency_transacted
         */

        $currency_transacted = standard_form_field_prep('currency_transacted', 1, 15);


        /**
         * Get $commodity_amount
         */

        $commodity_amount = float_form_field_prep('commodity_amount', 0.0, 999999999999999.99);


        /**
         * Get $commodity_type
         */

        $commodity_type = standard_form_field_prep('commodity_type', 1, 15);


        /**
         * Get $commodity_label
         *
         * Most typically this is a bitcoin address or something which can be perceived like it.
         */

        $commodity_label = bitcoin_address_form_field_prep('commodity_label');


        /**
         * Get $tax_year
         */

        $tax_year = integer_form_field_prep('tax_year', 1992, 65535);


        /**
         * Get $profit
         */

        $profit = float_form_field_prep('profit', 0.0, 999999999999999.99);


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