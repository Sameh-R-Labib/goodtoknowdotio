<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/3/18
 * Time: 5:06 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class AdminPassCodeGenFormProcessor
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage || $db === false)) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $community_array = Community::find_all($db, $sessionMessage);

        /**
         * Make sure the value of $_POST['choice'] is one of the existing community ids.
         * Otherwise, give error and redirect
         */
        $is_found = false;
        foreach ($community_array as $value) {
            if ($value->id == $_POST['choice']) {
                $is_found = true;
                break;
            }
        }
        if (!$is_found) {
            $sessionMessage .= " Aborted! choice is not valid. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Save choice in the session
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * Present a form where Admin can enter comments
         * about new person/user.
         */
        $html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}