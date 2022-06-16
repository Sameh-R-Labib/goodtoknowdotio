<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\bank_account_observer;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class destroy_a_bank_acct_observer_delete
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will Read $answer which is the choice of whether
         * to delete the bank_account_observer record. If 'yes' then
         * delete it. On the other hand if 'no' then reset
         * some session variables and redirect to the home page.
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

            breakout(' Message: 7258525 Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        get_db();

        $g->object = bank_account_observer::find_by_id($g->saved_int01);

        if (!$g->object) {

            breakout(' I was not able to find the record so I aborted. ');

        }

        $result = $g->object->delete();

        if (!$result) {

            breakout(' Error: 41232 Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        $g->message .= " I <b>deleted</b> the bank account observer. ";

        reset_feature_session_vars();

        redirect_to("/ax1/show_all_bank_acct_observers/page");
    }
}