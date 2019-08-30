<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class NukeATaxableIncomeEventDelete
{
    function page()
    {
        /**
         * 1) Store the submitted taxable_income_event record id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */

        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Store the submitted taxable_income_event record id in the session.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the taxable_income_event object with that id from the database.
         */

        $db = get_db();

        $object = TaxableIncomeEvent::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$object) {
            breakout(' Unexpectedly I could not find that taxable_income_event record. ');
        }


        /**
         * 3) Present a form which is populated with data from the taxable_income_event object
         *    and asks for approval for deletion to proceed.
         */

        /**
         * Replace attributes with more readable ones.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        $object->time = get_readable_time($object->time);
        $object->comment = nl2br($object->comment, false);
        $object->amount = readable_amount_of_money($object->currency, $object->amount);

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'nukeataxableincomeeventdelete.php';
    }
}