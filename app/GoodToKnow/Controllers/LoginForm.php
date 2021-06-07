<?php

namespace GoodToKnow\Controllers;

class LoginForm
{
    function page()
    {
        global $g;


        if ($g->is_logged_in) {

            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }


        $g->html_title = 'GoodToKnow.io';


        require VIEWS . DIRSEP . 'loginform.php';
    }
}