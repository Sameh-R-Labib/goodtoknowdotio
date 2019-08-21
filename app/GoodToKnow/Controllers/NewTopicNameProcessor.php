<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/12/18
 * Time: 3:50 PM
 */

namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class NewTopicNameProcessor
{
    function page()
    {
        /**
         * Mission:
         *   - Receive post data for topic_name
         *   - validate
         *   - Replace html tags with html entities
         *   - Add to session
         *   - Redirect to route for saving the new post
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $topic_name = standard_form_field_prep('topic_name', 1, 200);

        $topic_description = standard_form_field_prep('topic_description', 1, 230);

        if (is_null($topic_name) || is_null($topic_description)) {
            $sessionMessage .= " One or more values did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $topic_name;

        $_SESSION['saved_str02'] = $topic_description;

        redirect_to("/ax1/NewTopicSave/page");
    }
}