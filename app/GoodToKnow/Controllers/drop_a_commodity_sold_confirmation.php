<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity_sold;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class drop_a_commodity_sold_confirmation
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will read the choice of whether to delete the record. If yes then
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

        $object = commodity_sold::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' I was not able to find the record. ');

        }

        $result = $object->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' Your commodity sold has just been <b>deleted</b>. ');
    }
}