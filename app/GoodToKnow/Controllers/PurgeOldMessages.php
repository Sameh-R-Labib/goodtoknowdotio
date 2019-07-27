<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2018-12-24
 * Time: 18:32
 */

namespace GoodToKnow\Controllers;


class PurgeOldMessages
{
    function page()
    {
        /**
         * This is the first in a sequence of routes
         * for deleting the messages which are older
         * than a specified time.
         *
         * This first route will present a form in
         * which the admin will enter the time at
         * which all older messages be deleted.
         *
         * The time will be entered as a date.
         * The assumption is that all messages
         * sent before the zero hour (12am)
         * will be deleted.
         */

        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in OR !$is_admin) {
            $sessionMessage .= ' You need to be the Admin to follow that request route.';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Purge Old Messages';

        require VIEWS . DIRSEP . 'purgeoldmessages.php';
    }
}