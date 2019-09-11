<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\bitcoin_address_form_field_prep;
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

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        require_once CONTROLLERHELPERS . DIRSEP . 'bitcoin_address_form_field_prep.php';

        $string = bitcoin_address_form_field_prep('address');


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $address = standard_form_field_prep('address', 8, 264);

        $db = get_db();


        /**
         * Create a Bitcoin array for the record.
         */

        $array_bitcoin_record = ['user_id' => $user_id, 'address' => $address, 'initial_balance' => 0,
            'current_balance' => 0, 'currency' => '', 'price_point' => 0, 'time' => 0, 'comment' => ''];


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