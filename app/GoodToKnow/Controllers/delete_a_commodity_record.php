<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\make_commodity_readable;

class delete_a_commodity_record
{
    function page()
    {
        /**
         * presenting a form for getting the user to tell us which commodity record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_all_commodity_records_of_the_user.php';


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'make_commodity_readable.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($g->array_of_commodity_objects as $g->commodity_object) {

            make_commodity_readable();

        }


        require VIEWS . DIRSEP . 'deleteacommodityrecord.php';
    }
}