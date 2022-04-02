<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\username_for_specifying_which_prep;

class suspend_account_processor
{
    function page()
    {
        /**
         * Goal:
         *  1) Validate submitted username
         *  2) Save submitted username
         *  3) Redirect to a route
         */


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'username_for_specifying_which_prep.php';

        $submitted_username = username_for_specifying_which_prep();


        $_SESSION['saved_str01'] = $submitted_username;


        redirect_to("/ax1/suspend_account_suspend/page");
    }
}