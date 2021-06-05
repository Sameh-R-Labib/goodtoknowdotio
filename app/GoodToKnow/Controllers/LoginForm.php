<?php

namespace GoodToKnow\Controllers;

class LoginForm
{
    function page()
    {
        global $app_state;


        if ($app_state->is_logged_in) {

            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }


        $app_state->html_title = 'GoodToKnow.io';


        require VIEWS . DIRSEP . 'loginform.php';
    }
}