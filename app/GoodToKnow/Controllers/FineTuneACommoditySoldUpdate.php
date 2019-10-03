<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommoditySold;
use function GoodToKnow\ControllerHelpers\bitcoin_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class FineTuneACommoditySoldUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted finetuneacommoditysoldedit.php form data. (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
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
        /** @var $saved_int01 */

        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = CommoditySold::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->time_bought = $time_bought;
        $object->time_sold = $time_sold;
        $object->price_bought = $price_bought;
        $object->price_sold = $price_sold;
        $object->currency_transacted = $currency_transacted;
        $object->commodity_amount = $commodity_amount;
        $object->commodity_type = $commodity_type;
        $object->commodity_label = $commodity_label;
        $object->tax_year = $tax_year;
        $object->profit = $profit;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save($db, $sessionMessage);

        if ($result === false) {

            breakout(' I failed at saving the updated object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->commodity_label}</b>. ");
    }
}