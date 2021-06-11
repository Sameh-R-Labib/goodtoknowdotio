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


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_records_of_the_user.php';


        require VIEWS . DIRSEP . 'editabitcoinrecord.php';
    }
}