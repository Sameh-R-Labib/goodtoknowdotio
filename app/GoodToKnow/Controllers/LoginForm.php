<?php

namespace GoodToKnow\Controllers;

class LoginForm
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $html_title;


        if ($is_logged_in) {

            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }


        $html_title = 'GoodToKnow.io';


        require VIEWS . DIRSEP . 'loginform.php';
    }
}