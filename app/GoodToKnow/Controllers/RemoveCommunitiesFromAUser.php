<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-02-19
 * Time: 16:52
 */

namespace GoodToKnow\Controllers;


class RemoveCommunitiesFromAUser
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

        $html_title = 'Remove Communities from A User';

        require VIEWS . DIRSEP . 'removecommunitiesfromauser.php';
    }
}