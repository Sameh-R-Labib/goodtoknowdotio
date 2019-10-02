<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;
use GoodToKnow\Models\User;

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

        global $sessionMessage;
        global $saved_str01;

        kick_out_loggedoutusers();


        /**
         * $message_object and $db are defined when we include add_a_message_in_the_database.php.
         * I know the PhpStorm linter does not recognize this and marks up the code below as if
         * something is wrong with it. But I can't do anything about it.
         */


        /**
         * Verify that a string representing the message was submitted.
         * 'markdown'
         */

        require CONTROLLERINCLUDES . DIRSEP . "add_a_message_in_the_database.php";


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