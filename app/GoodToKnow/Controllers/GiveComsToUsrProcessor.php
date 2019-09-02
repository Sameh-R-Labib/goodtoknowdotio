<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\username_for_specifying_which_prep;

class GiveComsToUsrProcessor
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        kick_out_nonadmins();

        kick_out_onabort();


        /**
         * Goal:
         *  1) Validate $_POST['username']
         *  2) Save $_POST['username']
         *  3) Redirect to a route which will present a form with checkboxes for choosing communities
         */

        $db = get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'username_for_specifying_which_prep.php';

        $submitted_username = username_for_specifying_which_prep($db);

        $_SESSION['saved_str01'] = $submitted_username;

        redirect_to("/ax1/GiveComsChoices/page");
    }
}