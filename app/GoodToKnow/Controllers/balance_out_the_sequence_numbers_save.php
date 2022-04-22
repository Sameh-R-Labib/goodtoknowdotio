<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic;

class balance_out_the_sequence_numbers_save
{
    function page()
    {
        /**
         * $_SESSION['saved_arr01'] contains the records which have had their sequence numbers modified.
         * The purpose of this route is to:
         *      A) update the topic table if we're in a community
         *      OR
         *      B) update the post table if we're in a topic.
         * We are to update using the records found in the array $_SESSION['saved_arr01'].
         * STEPS:
         *  1) Update the database using the array we have.
         *  2) Compose a session message **based on success or failure**.
         *  3) Call breakout([the message]) to pass the message, reset session vars and redirect to home page.
         */


        global $g;


        /**
         * Preliminary things to take care of.
         */

        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * 1, 2, 3) All steps in one section of code.
         */

        get_db();

        // We will call the save function on each object.
        // It doesn't matter which type of object it is
        // since every type of object has a save() method.
        foreach ($_SESSION['saved_arr01'] as $item) {

            $result = $item->save();

        }


        /**
         * Report success.
         */

        breakout(" Success or failure?! Either way, the script has ended. ");
    }
}