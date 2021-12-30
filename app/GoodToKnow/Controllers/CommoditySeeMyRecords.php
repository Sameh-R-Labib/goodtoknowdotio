<?php

namespace GoodToKnow\Controllers;

class CommoditySeeMyRecords
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_commodity_records_of_the_user.php';


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($g->array_of_commodity_objects as $g->commodity_object) {

            require CONTROLLERINCLUDES . DIRSEP . 'transform_to_readable_the_commodity_record.php';

        }


        /**
         * Present the view.
         */

        $g->html_title = 'Your ₿ records';

        $g->page = 'CommoditySeeMyRecords';

        $g->show_poof = true;

        $g->message .= ' Here are your commodity records. ';

        require VIEWS . DIRSEP . 'commodityseemyrecords.php';
    }
}