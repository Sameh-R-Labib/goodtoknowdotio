<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class MessageTheAuthorProcessor
{
    function page()
    {
        /**
         * This function takes the submitted MessageTheAuthor form and saves the message in the messages table.
         * It also saves a record in the message_to_user table.
         */


        global $g;


        kick_out_loggedoutusers();


        /**
         * $g->message_object and $g->db are defined when we include add_a_message_in_the_database.php.
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

        $message_to_user_array = ['message_id' => $g->message_object->id, 'user_id' => $g->author_id];


        /**
         * Call array_to_object($array) to create the object in memory.
         */

        $message_to_user_object = MessageToUser::array_to_object($message_to_user_array);


        /**
         * Save that object to the database using save().
         */

        $result = $message_to_user_object->save();

        if (!$result) {

            breakout(' Unexpectedly unable to save message to user. ');

        }


        /**
         * Declare success.
         */

        breakout(" Your message to $g->author_username was sent! ");
    }
}