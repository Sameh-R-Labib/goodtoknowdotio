<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/16/18
 * Time: 3:05 PM
 */

namespace GoodToKnow\Controllers;


class BroadcastMsgProcessor
{
    public function page()
    {
        /**
         * This function takes the submitted broadcastmsg.php
         * form and saves the message and saves records in the
         * message_to_user table where each record represents
         * a user who will receive the message. In fact all
         * users will receive this message.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}