<?php


namespace GoodToKnow\Controllers;


class TransferPostOwnershipGetUsername
{
    function page()
    {
        /**
         * This will process the confirmation form
         * and generate a form whereby the admin
         * can supply the username of the person
         * who will become the new owner of the post.
         *
         * If the confirmation is negative then it
         * will reset the session variables used so far
         * and redirect to home page.
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

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            $sessionMessage .= " You didn't enter a choice. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if ($choice == "no") {
            $sessionMessage .= " You changed your mind about transferring ownership of the post. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'What is the username of the person?';

        require VIEWS . DIRSEP . 'transferpostownershipgetusername.php';
    }
}