<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/16/18
 * Time: 3:05 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Message;


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
        global $user_id;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Verify that a string representing
         * the message was submitted.
         * $_POST['markdown']
         */
        $markdown = (isset($_POST['markdown'])) ? $_POST['markdown'] : '';
        if (!isset($_POST['markdown']) || trim($markdown) === '') {
            $sessionMessage .= " The message you submitted was not saved because nothing was submitted. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        if (strlen($markdown) > 1500) {
            $sessionMessage .= " The message you submitted was not saved because the number of characters
            exceeded the maximum allowed for a message. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $parsedown_object = new \ParsedownExtra();
        $parsedown_object->setMarkupEscaped(true);
        $parsedown_object->setSafeMode(true);
        $html = $parsedown_object->text($markdown);

        $message_array = ['user_id' => $user_id, 'created' => time(), 'content' => $html];

        $message_object = Message::array_to_object($message_array);

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $result = $message_object->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " Unexpected save() was unable to save the new message. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Create an array of MessageToUser objects
         * One for each user in the system.
         */

        // Use that function which gets all the User objects.

    }
}