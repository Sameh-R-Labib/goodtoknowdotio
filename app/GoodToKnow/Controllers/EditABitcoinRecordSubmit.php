<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;
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

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submitted editabitcoinrecordprocessor.php form data.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_initial_balance = (isset($_POST['initial_balance'])) ? (float)$_POST['initial_balance'] : 0.0;

        $edited_current_balance = (isset($_POST['current_balance'])) ? (float)$_POST['current_balance'] : 0.0;

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        if (is_null($edited_currency)) {
            $sessionMessage .= " The currency you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $edited_price_point = (isset($_POST['price_point'])) ? (float)$_POST['price_point'] : 0.0;

        $edited_unix_time_at_purchase = (isset($_POST['unix_time_at_purchase'])) ? (int)$_POST['unix_time_at_purchase'] : 1560190617;

        $edited_comment = standard_form_field_prep('comment', 0, 800);

        if (is_null($edited_comment)) {
            $sessionMessage .= " Your comment you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Retrieve the existing record from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$bitcoin_object) {
            $sessionMessage .= " Unexpectedly I could not find that bitcoin record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */
        $bitcoin_object->initial_balance = $edited_initial_balance;
        $bitcoin_object->current_balance = $edited_current_balance;
        $bitcoin_object->currency = $edited_currency;
        $bitcoin_object->price_point = $edited_price_point;
        $bitcoin_object->unix_time_at_purchase = $edited_unix_time_at_purchase;
        $bitcoin_object->comment = $edited_comment;

        /**
         * 4) Update/save the updated record in the database.
         */
        $result = $bitcoin_object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated Bitcoin object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report success.
         */
        $sessionMessage .= " I've updated address {$bitcoin_object->address}'s record. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        redirect_to("/ax1/Home/page");
    }
}