<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Message;
use GoodToKnow\Models\MessageToUser;
use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class BroadcastMsgProcessor
{
    function page()
    {
        /**
         * This function takes the submitted broadcastmsg.php form and saves the message and saves records in the
         * message_to_user table where each record represents a user who will receive the message. In fact all
         * users will receive this message.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $user_id;

        kick_out_nonadmins();

        kick_out_onabort();


        /**
         * Verify that a string representing
         * the message was submitted.
         * $_POST['markdown']
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $markdown = standard_form_field_prep('markdown', 1, 1500);

        if (is_null($markdown)) {
            breakout(' The message did NOT pass validation. ');
        }

        $parsedown_object = new \ParsedownExtra();
        $parsedown_object->setMarkupEscaped(true);
        $parsedown_object->setSafeMode(true);
        $html = $parsedown_object->text($markdown);

        $message_array = ['user_id' => $user_id, 'created' => time(), 'content' => $html];

        $message_object = Message::array_to_object($message_array);

        $db = get_db();

        $result = $message_object->save($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpected I was unable to save the new message. ');
        }


        /**
         * Create an array of MessageToUser objects
         * One for each user in the system.
         */

        $array_of_user_objects = User::find_all($db, $sessionMessage);

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

        $result = MessageToUser::insert_multiple_objects($db, $sessionMessage, $array_of_messagetouser_objects);

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