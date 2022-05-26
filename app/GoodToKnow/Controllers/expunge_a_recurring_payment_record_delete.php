<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\recurring_payment;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class expunge_a_recurring_payment_record_delete
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will read the choice of whether to delete the recurring_payment record. If yes then
         * delete it. On the other hand if no then reset some session variables and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->answer = $answer;


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        /**
         * Do nothing if user changed mind.
         */

        if ($g->answer == "no") {

            breakout(' Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        get_db();

        $object = recurring_payment::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' I was NOT able to find the recurring payment. ');

        }

        $result = $object->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the recurring payment record. ');

        }


        // Report successful deletion of post.

        breakout(' Your recurring payment has just been <b>deleted</b>. ');
    }
}