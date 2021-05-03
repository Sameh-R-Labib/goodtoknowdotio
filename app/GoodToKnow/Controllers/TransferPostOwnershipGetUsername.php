<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class TransferPostOwnershipGetUsername
{
    function page()
    {
        /**
         * This will process the confirmation form and generate a form whereby the admin can supply the username of the
         * person who will become the new owner of the post.
         *
         * If the confirmation is negative then it will reset the session variables used so far and redirect to home page.
         */


        global $html_title;


        kick_out_nonadmins();


        /**
         * Do nothing if user changed mind.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_form_field_prep.php';

        $choice = yes_no_form_field_prep('choice');

        if ($choice == "no") {

            breakout(' You changed your mind about transferring ownership of the post. ');

        }


        /**
         * Present the view.
         */

        $html_title = 'What is the username of the person?';

        require VIEWS . DIRSEP . 'transferpostownershipgetusername.php';
    }
}