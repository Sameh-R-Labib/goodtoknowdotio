<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class EditABitcoinRecordSubmit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted editabitcoinrecordprocessor.php form data.
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         */


        global $g;
        // $g->saved_int01 bitcoin record id


        kick_out_loggedoutusers();


        /**
         * 1) Validate the submitted editabitcoinrecordprocessor.php form data.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        // initial_balance

        $edited_initial_balance = float_form_field_prep('initial_balance', 0.0, 21000000000.0);


        // current_balance

        $edited_current_balance = float_form_field_prep('current_balance', 0.0, 21000000000.0);


        // currency

        $edited_currency = standard_form_field_prep('currency', 1, 15);


        // price_point

        $edited_price_point = float_form_field_prep('price_point', 0.0, 999999999999999.99);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -


        // comment

        $edited_comment = standard_form_field_prep('comment', 0, 800);


        /**
         * 2) Retrieve the existing record from the database.
         */

        get_db();

        $g->bitcoin_object = Bitcoin::find_by_id($g->saved_int01);

        if (!$g->bitcoin_object) {

            breakout(' Unexpectedly I could not find that bitcoin record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $g->bitcoin_object->initial_balance = $edited_initial_balance;
        $g->bitcoin_object->current_balance = $edited_current_balance;
        $g->bitcoin_object->currency = $edited_currency;
        $g->bitcoin_object->price_point = $edited_price_point;
        $g->bitcoin_object->time = $g->time;
        $g->bitcoin_object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $g->bitcoin_object->save();

        if ($result === false) {

            breakout(' Failed operation to save the Bitcoin object. ');

        }


        /**
         * Report success.
         */

        breakout(" I've updated address {$g->bitcoin_object->address}'s record. ");
    }
}