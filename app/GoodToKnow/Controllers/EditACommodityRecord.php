<?php

namespace GoodToKnow\Controllers;

class EditACommodityRecord
{
    function page()
    {
        /**
         * This feature is for editing/updating a Commodity record.
         *
         * This route is for presenting a form for getting the user to tell us which Commodity record he wants to edit.
         * It will present a series of radio buttons to choose from.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_commodity_records_of_the_user.php';


        require VIEWS . DIRSEP . 'editacommodityrecord.php';
    }
}