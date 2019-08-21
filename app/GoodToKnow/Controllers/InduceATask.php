<?php


namespace GoodToKnow\Controllers;


class InduceATask
{
    function page()
    {
        /**
         * Create a task record based on a label for it.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Create a New Task';

        require VIEWS . DIRSEP . 'induceatask.php';
    }
}