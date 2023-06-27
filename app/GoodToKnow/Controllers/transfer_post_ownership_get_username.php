<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class transfer_post_ownership_get_username
{
    function page(string $answer = 'no')
    {
        /**
         * This will process the confirmation form and generate a form whereby Admin can supply the username of the
         * person who will become the new owner of the post.
         *
         * If the confirmation is negative then it will reset the session variables used so far and redirect to home page.
         */


        global $g;


        kick_out_nonadmins();


        /**
         * Do nothing if user changed mind.
         */


        $g->answer = $answer;


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        /**
         * Do nothing if Admin changed mind.
         */


        if ($g->answer == "no") {

            breakout(' You changed your mind about transferring ownership of the post. ');

        }


        /**
         * Present the view.
         */

        $g->html_title = 'What is the username of the person?';

        require VIEWS . DIRSEP . 'transferpostownershipgetusername.php';
    }
}