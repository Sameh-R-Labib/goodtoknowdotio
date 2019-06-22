<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;

class InitializeABitcoinRecordProcessor
{
    public function page()
    {
        /**
         * Create a database record in the
         * bitcoin table using the submitted bitcoin
         * address. The remaining field values
         * will be set to default values.
         *
         * $_POST['address']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        if (empty($address)) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($address) > 264 || strlen($address) < 8) {
            $sessionMessage .= " Either the address is too long or too short. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Create a Bitcoin array for the record.
         */
        $array_bitcoin_record = ['user_id' => $user_id, 'address' => $address, 'initial_balance' => 0,
            'current_balance' => 0, 'price_point' => 0, 'unix_time_at_purchase' => 0, 'comment' => ''];

        /**
         * Make the array into an in memory Bitcoin object for the record.
         */
        $bitcoin_object = Bitcoin::array_to_object($array_bitcoin_record);

        /**
         * Save the object.
         */
        $result = $bitcoin_object->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= ' The save method for Bitcoin returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The save method for Bitcoin did not return false but it did send back a message.
             Therefore, it probably did not create the Bitcoin record. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Wrap it up.
         */
        $sessionMessage .= " A new bitcoin record was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}