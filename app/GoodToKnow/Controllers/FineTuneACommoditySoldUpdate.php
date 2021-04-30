<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommoditySold;

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


        global $db;
        global $time_bought;
        global $time_sold;
        global $price_bought;
        global $price_sold;
        global $currency_transacted;
        global $commodity_amount;
        global $commodity_type;
        global $commodity_label;
        global $tax_year;
        global $profit;
        global $saved_int01;


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