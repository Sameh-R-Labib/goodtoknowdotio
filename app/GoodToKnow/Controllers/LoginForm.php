<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/26/18
 * Time: 9:12 AM
 */

namespace GoodToKnow\Controllers;


class LoginForm
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        if ($is_logged_in) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");
        }

        $html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'loginform.php';
    }
}