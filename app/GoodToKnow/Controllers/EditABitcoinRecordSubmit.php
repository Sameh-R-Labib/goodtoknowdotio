<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
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

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // bitcoin record id

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Validate the submitted editabitcoinrecordprocessor.php form data.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';


        // initial_balance

        $edited_initial_balance = float_form_field_prep('initial_balance', 0.0, 21000000000.0);


        // current_balance

        $edited_current_balance = float_form_field_prep('current_balance', 0.0, 21000000000.0);

        if (is_null($edited_initial_balance) || is_null($edited_current_balance)) {

            breakout(' Your balance value did not pass validation. ');

        }


        // currency

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        if (is_null($edited_currency)) {

            breakout(' The currency you entered did not pass validation. ');

        }


        // price_point

        $edited_price_point = float_form_field_prep('price_point', 0.0, 21000000000.0);

        if (is_null($edited_price_point)) {

            breakout(' Your price point value did not pass validation. ');

        }


        // time

        $edited_time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if (is_null($edited_time)) {

            breakout(' The time you entered did not pass validation. ');

        }

        if ($edited_time === 0) $edited_time = 1560190617;


        // comment

        $edited_comment = standard_form_field_prep('comment', 0, 800);

        if (is_null($edited_comment)) {

            breakout(' Your comment you entered did not pass validation. ');

        }


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$bitcoin_object) {
            breakout(' Unexpectedly I could not find that bitcoin record. ');
        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $bitcoin_object->initial_balance = $edited_initial_balance;
        $bitcoin_object->current_balance = $edited_current_balance;
        $bitcoin_object->currency = $edited_currency;
        $bitcoin_object->price_point = $edited_price_point;
        $bitcoin_object->time = $edited_time;
        $bitcoin_object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $bitcoin_object->save($db, $sessionMessage);

        if ($result === false) {
            breakout(' Failed operation to save the Bitcoin object. ');
        }


        /**
         * Report success.
         */

        breakout(" I've updated address {$bitcoin_object->address}'s record. ");
    }
}