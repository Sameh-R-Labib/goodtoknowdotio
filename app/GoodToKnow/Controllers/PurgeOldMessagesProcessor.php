<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2018-12-27
 * Time: 22:19
 */

namespace GoodToKnow\Controllers;


class PurgeOldMessagesProcessor
{
    public function page()
    {
        /**
         * This code will:
         *   1) Receive submitted date.
         *   2) Delete the messages.
         *   3) Report success or failure.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Variables to work with:
         *   $_POST['date'], $_POST['submit']
         */

        /**
         * I can't assume these post variables exist so I do the following.
         */

        $submitted_date = (isset($_POST['date'])) ? $_POST['date'] : '';
//        $submitted_submit = (isset($_POST['submit'])) ? $_POST['submit'] : '';


    }
}