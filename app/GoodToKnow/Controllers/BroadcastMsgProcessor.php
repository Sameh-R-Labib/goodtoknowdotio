<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;
use GoodToKnow\Models\User;

class BroadcastMsgProcessor
{
    function page()
    {
        /**
         * This function takes the submitted broadcastmsg.php form and saves the message and saves records in the
         * message_to_user table where each record represents a user who will receive the message. In fact all
         * users will receive this message.
         */

        global $db;
        global $message_object;
        global $gtk;


        kick_out_nonadmins();


        /**
         * Verify that a string representing
         * the message was submitted.
         * 'markdown'
         */

        require CONTROLLERINCLUDES . DIRSEP . "add_a_message_in_the_database.php";


        /**
         * Create an array of MessageToUser objects
         * One for each user in the system.
         */

        $array_of_user_objects = User::find_all();

        if (!$array_of_user_objects) {

            breakout(' Unexpected I was unable to find any users. ');

        }


        /**
         * Iterate over the array of user objects to build the array of MessageToUser objects.
         * Each MessageToUser object will hold a user id and the id of the message we created above.
         *
         * The id of the message crated above is found in $message_object->id.
         */

        $array_of_messagetouser_objects = [];

        foreach ($array_of_user_objects as $user_object) {
            $messagetouser_object_as_array = ['message_id' => $message_object->id, 'user_id' => $user_object->id];

            $array_of_messagetouser_objects[] = MessageToUser::array_to_object($messagetouser_object_as_array);
        }


        /**
         * Save all these MessageToUser objects in the database.
         */

        $result = MessageToUser::insert_multiple_objects($array_of_messagetouser_objects);

        if (!$result) {

            breakout(' In BroadcastMsgProcessor encountered unexpected the fact that MessageToUser::insert_multiple_objects
             was unable to save message_to_user records for the message and all users. ');

        }


        /**
         * Declare success.
         */

        breakout(' Your message was sent to all! ');
    }
}