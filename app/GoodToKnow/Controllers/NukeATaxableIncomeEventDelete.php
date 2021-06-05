<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class NukeATaxableIncomeEventDelete
{
    function page()
    {
        /**
         * 1) Store the submitted taxable_income_event record id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */


        global $object;
        global $gtk;


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_taxableincomeevent.php';


        /**
         * 4) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */

        // Replace attributes with more readable ones.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        $object->time = get_readable_time($object->time);
        $object->comment = nl2br($object->comment, false);
        $object->amount = readable_amount_of_money($object->currency, $object->amount);

        $gtk->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'nukeataxableincomeeventdelete.php';
    }
}