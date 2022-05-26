<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class delete_a_commodity_record_delete
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will read the choice of whether to delete the commodity record. If yes then delete it.
         * On the other hand if no then reset some session variables and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->answer = $answer;

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';

        yes_no_parameter_validation();


        /**
         * Do nothing if user changed mind.
         */

        if ($g->answer) {

            breakout(' Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        get_db();

        $commodity = commodity::find_by_id($g->saved_int01);

        if (!$commodity) {

            breakout(' I was NOT able to find the commodity record. ');

        }


        $result = $commodity->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the commodity record. ');

        }


        // Report successful deletion of post.

        breakout(' I\'ve <b>deleted</b> the commodity record. ');
    }
}