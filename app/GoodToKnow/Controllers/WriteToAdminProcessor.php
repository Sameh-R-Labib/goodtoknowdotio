<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class WriteToAdminProcessor
{
    function page()
    {
        /**
         * This function takes the submitted WriteToAdmin
         * form and saves the message in the messages table.
         * It also saves a record in the message_to_user table.
         */

        global $sessionMessage;

        // ADMINUSERID   constant
        // ADMINUSERNAME constant

        kick_out_loggedoutusers();


        /**
         * $message_object and $db are defined when we include add_a_message_in_the_database.php.
         * I know the PhpStorm linter does not recognize this and marks up the code below as if
         * something is wrong with it. But I can't do anything about it.
         */


        require CONTROLLERINCLUDES . DIRSEP . "add_a_message_in_the_database.php";


        /**
         * Create an associative array containing the attribute names and values.
         *   WARNING: Do Not include id attribute. Do Include all other attributes and assign them values.
         *
         * Attributes:
         *  - message_id
         *  - user_id
         */

        /** @noinspection PhpUndefinedVariableInspection */

        $message_to_user_array = ['message_id' => $message_object->id, 'user_id' => ADMINUSERID];


        /**
         * Call array_to_object($array) to create the object in memory.
         */

        $message_to_user_object = MessageToUser::array_to_object($message_to_user_array);


        /**
         * Save that object to the database using save().
         */

        /** @noinspection PhpUndefinedVariableInspection */

        $result = $message_to_user_object->save($db, $sessionMessage);

        if (!$result) {

            breakout(' Unexpectedly I was unable to save the message-to-user record. ');

        }


        /**
         * Declare success.
         */

        $admin_username = ADMINUSERNAME;

        breakout(" Your message to {$admin_username} was sent ✔️. ");
    }
}