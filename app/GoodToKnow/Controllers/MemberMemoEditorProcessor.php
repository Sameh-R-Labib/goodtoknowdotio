<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class MemberMemoEditorProcessor
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * Goal:
         *  1) Validate $_POST['username']
         *  2) Save $_POST['username']
         *  3) Redirect to a route
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_username = standard_form_field_prep('username', 7, 12);

        if (is_null($submitted_username)) {
            breakout(' The username you entered did not pass validation. ');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $is_username = GiveComsToUsrProcessor::is_username_in_our_system($db, $sessionMessage, $submitted_username);

        if (!$is_username) {
            breakout(' The username is not valid. ');
        }

        $_SESSION['saved_str01'] = $submitted_username;

        redirect_to("/ax1/MemberMemoEditorForm/page");
    }
}