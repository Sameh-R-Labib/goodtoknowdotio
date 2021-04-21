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

        /**
         * 1) Update the database using the array we have.
         */
    }
}