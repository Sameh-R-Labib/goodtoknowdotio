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


        // - - -


        /**
         * Get `timezone`.
         */

        $timezone = standard_form_field_prep('timezone', 2, 60);


        /**
         * Use $timezone to set the default timezone for the script to use.
         */

        date_default_timezone_set($timezone);


        /**
         * Get `date`.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';

        $date = date_form_field_prep('date');


        /**
         * Get a timestamp from `date`.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_timestamp_from_date.php';

        $timestamp = get_timestamp_from_date($date);


        /**
         * Get `hour`.
         */

        $hour = integer_form_field_prep('hour', 0, 23);


        /**
         * Update $timestamp with $hour.
         */

        $timestamp += 3600 * $hour;


        /**
         * Get `minute`.
         */

        $minute = integer_form_field_prep('minute', 0, 59);


        /**
         * Update $timestamp with $minute.
         */

        $timestamp += 60 * $minute;


        /**
         * Get `second`.
         */

        $second = integer_form_field_prep('second', 0, 59);


        /**
         * Update $timestamp with $second.
         */

        $timestamp += $second;


        // - - -


        $time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if ($time === 0) $time = 1560190617;


        // + + + Debug Code

        echo "<p>Print_r \$timestamp: </p>\n<pre>";
        print_r($timestamp);
        echo "</pre>\n";
        die("<p>End debug</p>\n");
        echo "<p>Print_r \$time: </p>\n<pre>";
        print_r($time);
        echo "</pre>\n";
        die("<p>End debug</p>\n");


        // + + +

        $comment = standard_form_field_prep('comment', 0, 800);


        $db = get_db();


        /**
         * Create a Bitcoin array for the record.
         */

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