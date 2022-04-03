<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\message_to_user;
use GoodToKnow\Models\User;

class broadcast_msg_processor
{
    function page()
    {
        /**
         * This function takes the submitted broadcastmsg.php form and saves the message and saves records in the
         * message_to_user table where each record represents a user who will receive the message. In fact all
         * users will receive this message.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        /**
         * Verify that a string representing
         * the message was submitted.
         * 'markdown'
         */

        require CONTROLLERINCLUDES . DIRSEP . "add_a_message_in_the_database.php";


        /**
         * Create an array of message_to_user objects
         * One for each user in the system.
         */

        $array_of_user_objects = User::find_all();

        if (!$array_of_user_objects) {

            breakout(' Unexpected I was unable to find any users. ');

        }


        /**
         * Iterate over the array of user objects to build the array of message_to_user objects.
         * Each message_to_user object will hold a user id and the id of the message we created above.
         *
         * The id of the message crated above is found in $g->message_object->id.
         */

        $array_of_messagetouser_objects = [];

        foreach ($array_of_user_objects as $user_object) {

            $messagetouser_object_as_array = ['message_id' => $g->message_object->id, 'user_id' => $user_object->id];

            $array_of_messagetouser_objects[] = message_to_user::array_to_object($messagetouser_object_as_array);

        }


        /**
         * Save all these message_to_user objects in the database.
         */

        $result = message_to_user::insert_multiple_objects($array_of_messagetouser_objects);

        if (!$result) {

            breakout(' In broadcast_msg_processor encountered unexpected the fact that message_to_user::insert_multiple_objects
             was unable to save message_to_user records for the message and all users. ');

        }


        /**
         * Declare success.
         */

        breakout(' Your message was sent to all! ');
    }
}