<?php


namespace GoodToKnow\Controllers;


class EditABitcoinRecordProcessor
{
    public function page()
    {
        /**
         * 1) Store the submitted bitcoin record id in the session.
         * 2) Retrieve the object with that id from the database.
         * 3) Present a form which is populated with data from the object.
         *    (except do the bitcoin address should not be changeable.)
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


    }
}