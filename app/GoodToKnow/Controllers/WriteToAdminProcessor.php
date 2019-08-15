<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/2/18
 * Time: 10:12 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Message;
use GoodToKnow\Models\MessageToUser;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class WriteToAdminProcessor
{
    function page()
    {
        /**
         * This function takes the submitted WriteToAdmin
         * form and saves the message in the messages table.
         * It also saves a record in the message_to_user table.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        // ADMINUSERID   constant
        // ADMINUSERNAME constant

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
         * Verify that a string representing
         * the message was submitted.
         * $_POST['markdown']
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $markdown = standard_form_field_prep('markdown', 1, 1500);

        if (is_null($markdown)) {
            $sessionMessage .= " The message you submitted did NOT pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Generate the html equivalent for $markdown.
         */
        $parsedown_object = new \ParsedownExtra();
        $parsedown_object->setMarkupEscaped(true);
        $parsedown_object->setSafeMode(true);
        $html = $parsedown_object->text($markdown);

        /**
         * Create an associative array containing the attribute names and values.
         *   WARNING: Do Not include id attribute. Do Include all other attributes and assign them values.
         *
         * Attributes:
         *  - user_id
         *  - created
         *  - content
         */
        $message_array = ['user_id' => $user_id, 'created' => time(), 'content' => $html];

        /**
         * Call array_to_object($array) to create the object in memory.
         */
        $message_object = Message::array_to_object($message_array);

        /**
         * Save that object to the database using save().
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
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
         * Create an associative array containing the attribute names and values.
         *   WARNING: Do Not include id attribute. Do Include all other attributes and assign them values.
         *
         * Attributes:
         *  - message_id
         *  - user_id
         */
        $message_to_user_array = ['message_id' => $message_object->id, 'user_id' => ADMINUSERID];

        /**
         * Call array_to_object($array) to create the object in memory.
         */
        $message_to_user_object = MessageToUser::array_to_object($message_to_user_array);

        /**
         * Save that object to the database using save().
         */
        $result = $message_to_user_object->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " Unexpected save() was unable to save a message_to_user record for the message. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Declare success.
         */
        $admin_username = ADMINUSERNAME;
        $_SESSION['message'] = " Your message to {$admin_username} was sent! ";
        redirect_to("/ax1/Home/page");
    }
}