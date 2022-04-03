<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\username_for_specifying_which_prep;

class remove_coms_from_user_processor
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Goal:
         *  1) Validate 'username'
         *  2) Save 'username'
         *  3) Redirect to a route which will present a form with checkboxes for choosing communities
         */

        get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'username_for_specifying_which_prep.php';

        $submitted_username = username_for_specifying_which_prep();


        $_SESSION['saved_str01'] = $submitted_username;


        redirect_to("/ax1/remove_coms_choices/page");
    }
}