<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-27
 * Time: 18:05
 */

namespace GoodToKnow\Controllers;


class UnsuspendAccount
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Present a form which collects
         * the username.
         */

        $html_title = "Unsuspend Account";

        require VIEWS . DIRSEP . 'unsuspendaccount.php';
    }
}