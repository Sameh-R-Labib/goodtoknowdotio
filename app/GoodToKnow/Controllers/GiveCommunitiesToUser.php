<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-08
 * Time: 17:49
 */

namespace GoodToKnow\Controllers;


class GiveCommunitiesToUser
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

        $html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}