<?php

namespace GoodToKnow\Controllers;

class EditABitcoinRecord
{
    function page()
    {
        /**
         * This feature is for editing/updating a Bitcoin record.
         *
         * This route is for presenting a form for getting the user to tell us which Bitcoin record he wants to edit.
         * It will present a series of radio buttons to choose from.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_records_of_the_user.php';

        /**
         * Debug Code
         */
        $return_of_function_call = date_default_timezone_get();

        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$timezone: </p>\n<pre>";
        var_dump($timezone);
        echo "</pre>\n";
        echo "<p>Var_dump \$return_of_function_call: </p>\n<pre>";
        var_dump($return_of_function_call);
        echo "</pre>\n";
        die("<p>End debug</p>\n");

        require VIEWS . DIRSEP . 'editabitcoinrecord.php';
    }
}