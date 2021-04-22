<?php


namespace GoodToKnow\Controllers;


class BalanceOutTheSequenceNumbersSave
{
    function page()
    {
        /**
         * $_SESSION['saved_arr01'] contains the records which have had their sequence numbers modified.
         * The purpose of this route is to:
         *      A) update the Topics table if we're in a Community
         *      OR
         *      B) update the Posts table if we're in a Topic.
         * We are to update using the records found in the array $_SESSION['saved_arr01'].
         * STEPS:
         *  1) Update the database using the array we have.
         *  2) Compose a session message **based on success or failure**.
         *  3) Call breakout([the message]) to pass the message, reset session vars and redirect to Home page.
         */

        global $is_admin;
        global $is_logged_in;
        global $sessionMessage;
        global $type_of_resource_requested;
        global $community_id;
        global $topic_id;

        /**
         * Preliminary things to take care of.
         */

        kick_out_nonadmins();

        $thing_type = ucfirst($type_of_resource_requested);

        /**
         * 1) Update the database using the array we have.
         */

        // The function we call will be different based on which types of objects we have.
        if ($thing_type === 'Community') {
            // Using $_SESSION['saved_arr01'], update the topics table.
        } else {
            // Using $_SESSION['saved_arr01'], update the posts table.
        }
    }
}