<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class nuke_a_taxable_income_event_delete
{
    function page(int $id = 0)
    {
        /**
         * 1) Store the submitted taxable_income_event record id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_taxableincomeevent.php';


        /**
         * 4) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */

        // Replace attributes with more readable ones.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        $g->object->time = get_readable_time($g->object->time);
        $g->object->comment = nl2br($g->object->comment, false);
        $g->object->amount = readable_amount_of_money($g->object->currency, $g->object->amount);
        $g->object->price = readable_amount_of_money($g->object->fiat, $g->object->price);

        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'nukeataxableincomeeventdelete.php';
    }
}