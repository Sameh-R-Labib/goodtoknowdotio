<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class EditABitcoinRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted bitcoin record id in the session.
         * 2) Retrieve the object with that id from the database.
         * 3) Present a form which is populated with data from the object.
         *    (except the bitcoin address should not be changeable.)
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted bitcoin record id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$bitcoin_object) {
            $sessionMessage .= " Unexpectedly I could not find that bitcoin record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the object.
         *    (except do the bitcoin address should not be changeable.)
         */
        $html_title = 'Edit the bitcoin record';

        require VIEWS . DIRSEP . 'editabitcoinrecordprocessor.php';
    }
}