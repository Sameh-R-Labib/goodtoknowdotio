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


        global $g;
        global $db;
        global $commodity_type;
        global $commodity_label;
        global $tax_year;
        global $profit;


        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = CommoditySold::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->time_bought = $g->time_bought;
        $object->time_sold = $g->time_sold;
        $object->price_bought = $g->price_bought;
        $object->price_sold = $g->price_sold;
        $object->currency_transacted = $g->currency_transacted;
        $object->commodity_amount = $g->commodity_amount;
        $object->commodity_type = $commodity_type;
        $object->commodity_label = $commodity_label;
        $object->tax_year = $tax_year;
        $object->profit = $profit;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->commodity_label}</b>. ");
    }
}