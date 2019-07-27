<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-13
 * Time: 21:16
 */

namespace GoodToKnow\Controllers;


class SuspendAccount
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Present a form which collects
         * the username.
         */

        $html_title = "Suspend Account";

        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}