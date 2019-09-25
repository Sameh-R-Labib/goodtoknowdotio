<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\bitcoin_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\get_timestamp_from_date;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class InitializeABitcoinRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the bitcoin table using the submitted data.
         *
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        require_once CONTROLLERHELPERS . DIRSEP . 'bitcoin_address_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $address = bitcoin_address_form_field_prep('address');

        $initial_balance = float_form_field_prep('initial_balance', 0.0, 21000000000.0);

        $current_balance = float_form_field_prep('current_balance', 0.0, 21000000000.0);

        $currency = standard_form_field_prep('currency', 1, 15);

        $price_point = float_form_field_prep('price_point', 0.0, 21000000000.0);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_from_form_submission.php';

        // - - -


        $comment = standard_form_field_prep('comment', 0, 800);


        $db = get_db();


        /**
         * Create a Bitcoin array for the record.
         */

        /** @noinspection PhpUndefinedVariableInspection */

        $array_bitcoin_record = ['user_id' => $user_id, 'address' => $address, 'initial_balance' => $initial_balance,
            'current_balance' => $current_balance, 'currency' => $currency, 'price_point' => $price_point,
            'time' => $time, 'comment' => $comment];


        /**
         * Make the array into an in memory Bitcoin object for the record.
         */

        $bitcoin_object = Bitcoin::array_to_object($array_bitcoin_record);


        /**
         * Save the object.
         */

        $result = $bitcoin_object->save($db, $sessionMessage);

        if (!$result) {
            breakout(' The save method for Bitcoin returned false. ');
        }

        if (!empty($sessionMessage)) {
            breakout(' The save method for Bitcoin did not return false but it did send back a message.
             Therefore, it probably did not create the Bitcoin record. ');
        }


        /**
         * Wrap it up.
         */

        breakout(' A new bitcoin record was created 👏. ');
    }
}