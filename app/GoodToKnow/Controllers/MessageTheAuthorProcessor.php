<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/2/18
 * Time: 5:17 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Message;
use GoodToKnow\Models\MessageToUser;


class MessageTheAuthorProcessor
{
    public function page()
    {
        /**
         * This function takes the submitted MessageTheAuthor
         * form and saves the message in the messages table.
         * It also saves a record in the message_to_user table.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $author_id;
        global $author_username;

        if (!$is_logged_in || !empty($sessionMessage)) {
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
        $message_to_user_array = ['message_id' => $message_object->id, 'user_id' => $author_id];

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
        $_SESSION['message'] = " Your message to {$author_username} was sent successfully! ";
        redirect_to("/ax1/Home/page");
    }
}