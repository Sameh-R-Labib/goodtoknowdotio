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
         * Before I start, I just want to take a look at what's in $_SESSION['saved_arr01'].
         */
        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$_SESSION['saved_arr01']: </p>\n<pre>";
        var_dump($_SESSION['saved_arr01']);
        echo "</pre>\n";
        die("<p>End debug</p>\n");
    }
}