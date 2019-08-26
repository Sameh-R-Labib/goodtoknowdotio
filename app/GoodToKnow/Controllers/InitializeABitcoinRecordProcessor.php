<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class InitializeABitcoinRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the bitcoin table using the submitted bitcoin
         * address. The remaining field values will be set to default values.
         *
         * $_POST['address']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * I need to make sure the address doesn't have any characters which
         * would be altered by htmlspecialchars
         */

        $found = false;

        $array_of_html_chars = ['&', '"', '\'', '<', '>'];

        $string = (isset($_POST['address'])) ? $_POST['address'] : '';

        $array = str_split($string);

        foreach ($array as $char) {

            if (in_array($char, $array_of_html_chars)) {

                $found = true;
                break;
            }
        }

        if ($found) {
            breakout(' I can\'t use this address because it has an HTML special character. ');
        }


        /**
         * End: I need to ...
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $address = standard_form_field_prep('address', 8, 264);

        if (is_null($address)) {
            breakout(' The address you entered did not pass validation. ');
        }

        $db = get_db();


        /**
         * Create a Bitcoin array for the record.
         */

        $array_bitcoin_record = ['user_id' => $user_id, 'address' => $address, 'initial_balance' => 0,
            'current_balance' => 0, 'currency' => '', 'price_point' => 0, 'unix_time_at_purchase' => 0, 'comment' => ''];


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