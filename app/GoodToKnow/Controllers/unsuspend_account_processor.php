<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\username_for_specifying_which_prep;

class unsuspend_account_processor
{
    function page()
    {
        global $g;

        kick_out_nonadmins();


        /**
         * Goal:
         *  1) Validate 'username'
         *  2) Save 'username'
         *  3) Redirect to a route
         */

        get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'username_for_specifying_which_prep.php';

        $submitted_username = username_for_specifying_which_prep();


        $_SESSION['saved_str01'] = $submitted_username;


        redirect_to("/ax1/unsuspend_account_unsuspend/page");
    }
}