<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\make_commodity_readable;

class delete_a_commodity_record_processor
{
    function page(int $id = 0)
    {
        /**
         * 1) Determines the id of the commodity record from 'choice' and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the commodity object with that id from the database.
         * 3) Verify the object belongs to the user.
         * 4) Presents a form containing data from the record and asking for confirmation to delete.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'get_commodity_record_of_user.php';


        /**
         * 4) Presents a form containing data from the record and asking for confirmation to delete.
         */

        // Format the attributes for easy viewing

        require_once CONTROLLERHELPERS . DIRSEP . 'make_commodity_readable.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        make_commodity_readable();

        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'deleteacommodityrecordprocessor.php';
    }
}