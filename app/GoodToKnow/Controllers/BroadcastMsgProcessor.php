<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/16/18
 * Time: 3:05 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Message;
use GoodToKnow\Models\MessageToUser;
use GoodToKnow\Models\User;


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
         * Good Code So Far
         */

        /**
         * Create an array of MessageToUser objects
         * One for each user in the system.
         */

        $array_of_user_objects = User::find_all($db, $sessionMessage);
        if (!$array_of_user_objects) {
            $sessionMessage .= " Unexpected User::find_all() was unable to find any users. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Iterate over the array of user objects
         * to build the array of MessageToUser objects.
         * Each MessageToUser object will hold a user id
         * and the id of the message we created above.
         *
         * The id of the message crated above is found
         * in $message_object->id.
         */
        //$message_to_user_array = ['message_id' => $message_object->id, 'user_id' => $author_id];
        $array_of_messagetouser_objects = [];
        foreach ($array_of_user_objects as $user_object) {
            $messagetouser_object_as_array = ['message_id' => $message_object->id, 'user_id' => $user_object->id];
            $array_of_messagetouser_objects[] = MessageToUser::array_to_object($messagetouser_object_as_array);
        }

        /**
         * Save all these MessageToUser objects in the database.
         */
        $result = MessageToUser::insert_multiple_objects($db, $sessionMessage, $array_of_messagetouser_objects);
        if (!$result) {
            $sessionMessage .= " Unexpected MessageToUser::insert_multiple_objects was unable to save message_to_user
             records for the message and all users. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Declare success.
         */
        $_SESSION['message'] = " Your message to all users was sent successfully! ";
        redirect_to("/ax1/Home/page");
    }
}