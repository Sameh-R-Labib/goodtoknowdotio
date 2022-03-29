<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;
use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;


class blot_out_some_inbox_messages_processor
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'checkbox_section_form_field_prep.php';

        $submitted_message_ids_array = checkbox_section_form_field_prep('choice-');


        if (empty($submitted_message_ids_array)) {

            breakout(' You did not submit any message ids. ');

        }


        /**
         * Make sure the data is numeric.
         */

        foreach ($submitted_message_ids_array as $item) {

            if (!is_numeric($item)) {

                breakout(' Unexpectedly one or more values turned out to be non-numeric.');
            }

        }


        /**
         * Delete each of the chosen messages.
         */

        get_db();

        foreach ($submitted_message_ids_array as $id) {

            // Only delete the MessageToUser record. Do Not delete the Message record since it may be needed by another user.

            $return = MessageToUser::delete_all_particular($id, $g->user_id);

            if ($return === false) {

                breakout(' Message deletion failed. ');

            }

        }


        /**
         * Declare success.
         */

        breakout(" Message deletion completed. ");

    }

}