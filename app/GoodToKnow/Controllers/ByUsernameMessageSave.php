<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Message;
use GoodToKnow\Models\MessageToUser;
use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class ByUsernameMessageSave
{
    function page()
    {
        /**
         * Before I get started:
         *   Know that $_SESSION['saved_str01'] = $submitted_username.
         */

        /**
         * This function takes the submitted byusernamemprocessor.php
         * form and saves the message in the messages table.
         * It ALSO saves a record in the message_to_user table.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;        // logged in user's ID number
        global $saved_str01;

        kick_out_loggedoutusers();

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * Verify that a string representing the message was submitted.
         * $_POST['markdown']
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $markdown = standard_form_field_prep('markdown', 1, 1500);

        if (is_null($markdown)) {
            breakout(' The markdown is NOT validation. ');
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

        $db = get_db();

        $result = $message_object->save($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpected I was unable to save the new message. ');
        }


        /**
         * Here I need find the user ID number of
         * the target for the message. I already
         * know the username. It is stored in
         * $saved_str01.
         */

        if (empty($saved_str01)) {
            breakout(' Unexpectedly no target username found in the session. ');
        }

        $target_user_object = User::find_by_username($db, $sessionMessage, $saved_str01);

        if (!$target_user_object) {
            breakout(' Unexpectedly unable to retrieve target user\'s object. ');
        }


        /**
         * Create an associative array containing the attribute names and values.
         *   WARNING: Do Not include id attribute. Do Include all other attributes and assign them values.
         *
         * Attributes:
         *  - message_id
         *  - user_id
         */


        $message_to_user_array = ['message_id' => $message_object->id, 'user_id' => $target_user_object->id];


        /**
         * Call array_to_object($array) to create the object in memory.
         */

        $message_to_user_object = MessageToUser::array_to_object($message_to_user_array);


        /**
         * Save that object to the database using save().
         */

        $result = $message_to_user_object->save($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpectedly unable to save the message. ');
        }


        /**
         * Declare success.
         */

        breakout(" Your message to {$saved_str01} was sent! ");
    }
}